<?php
// Document Access Logging Endpoint
header('Content-Type: application/json');

// Include database configuration
require_once __DIR__ . '/../../config/database.php';

// Start session to get user_id
session_start();

try {
    // Get POST data
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (!isset($input['doc_name'])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Document name is required']);
        exit;
    }
    
    $doc_name = $input['doc_name'];
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    $ip_address = $_SERVER['REMOTE_ADDR'] ?? null;
    $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? null;
    
    // Insert log entry
    $query = "INSERT INTO docs_log (doc_name, user_id, date_read, ip_address, user_agent) 
              VALUES (:doc_name, :user_id, GETDATE(), :ip_address, :user_agent)";
    
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':doc_name', $doc_name);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':ip_address', $ip_address);
    $stmt->bindParam(':user_agent', $user_agent);
    
    if ($stmt->execute()) {
        http_response_code(200);
        echo json_encode([
            'success' => true,
            'message' => 'Document access logged successfully',
            'log_id' => $conn->lastInsertId()
        ]);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Failed to log document access']);
    }
    
} catch (Exception $e) {
    http_response_code(500);
    error_log("Document Logging Error: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'An error occurred while logging access']);
}
?>
