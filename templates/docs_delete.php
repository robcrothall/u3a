<?php
/**
 * Program: docs_delete
 * 
 * Delete a document.
 * php version 5
 * 
 * @category WebPage
 * @package  Sample
 * @author   "Rob Crothall" <rob@crothall.co.za>
 * @license  GPL 1.0 or later
 * @version  GIT: <git_id>
 * @link     http://www.sprv.co.za
 */
require "../inc/config.php"; 
$_SESSION["module"] = $_SERVER["PHP_SELF"];
require "../inc/head.php";
require "../inc/body.php";
require "../inc/menu.php";
require "../inc/msg.php";
echo '<h1>Delete a Document</h1>';
$errorList = [];
if ((!isset($_GET['docs_id'])) || (trim($_GET['docs_id'] == ''))) {
    $message = 'Missing record ID - please inform SysAdmin.';
} else {
    $req_id = test_input($_GET['docs_id']);
    include "../inc/db_open.php";
    $sql = "select doc_name, doc_path, doc_file from docs where id = ?";
    $rows = query($sql, $req_id);
    //var_dump($rows);
    $doc_name = $rows[0]["doc_name"];
    $doc_path = $rows[0]["doc_path"];
    $doc_file = $rows[0]["doc_file"];
    $full_path = $doc_path . $doc_file;
    //var_dump($doc_name);
    $sql = "select people_id from people_docs where docs_id = ?";
    $rows = query($sql, $req_id);
    //var_dump($rows);
    if (count($rows) > 0) {
        $errorList[] = "The following people are still associated with '$doc_name':<br>";
    }
    foreach ($rows as $row) {
        $people_id = $row["people_id"];
        $sql = "select surname, first_name, given_name ";
        $sql .= "from people ";
        $sql .= "where id = ? ";
        $r1 = query($sql, $people_id);
        $full_name = $r1[0]["surname"] . ", " . $r1[0]["first_name"];
        if (strlen($r1[0]["given_name"]) > 0) {
            $full_name .= " (" . $r1[0]["given_name"] . ")";
        }
        $errorList[] = $full_name . "<br>";
    }
    if (sizeof($errorList) == 0) {
        $message = "";
        if (unlink($full_path)) {
            $message .= "File " . $doc_file . " has been deleted. ";
        } else {
            $message .= "There was an error deleting the file " . $doc_file;
        }
        $sql = "delete from docs where id = " . $req_id;
        $result = mysqli_query($handle, $sql);
        if ($result <> false) {
            $message .= "Document '" . $doc_name . "' has been deleted.";
        } else {
            $message .= "Unable to delete document $doc_name - ";
            $message .= "please inform SysAdmin.";
        }
    } else {
        echo 'The following errors were encountered:<br>';
        echo '<ul>';
        for ($x=0; $x<sizeof($errorList); $x++) {
            echo "<li>$errorList[$x]";
        }
        echo '</ul>';    
    }
}
echo '<br><br><a class="w3-button w3-green" ';
echo 'href="../page/docs_list.php">Back to document list</a>';
require "../inc/msg.php";
require "../inc/footer.php";
?>
