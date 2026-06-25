<?php
/**
 * Program: docs_type_delete
 * 
 * Delete a document type.
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
echo '<h1>Delete a Document Type</h1>';
$errorList = [];
if ((!isset($_GET['id'])) || (trim($_GET['id'] == ''))) {
    $message = 'Missing record ID - please inform SysAdmin.';
} else {
    $req_id = test_input($_GET['id']);
    include "../inc/db_open.php";
    $sql = "select description from docs_type where id = ?";
    $rows = query($sql, $req_id);
    //var_dump($rows);
    $description = $rows[0]["description"];
    //var_dump($doc_name);
    $sql = "select doc_group, doc_subgroup, doc_name from docs where docs_type = ?";
    $rows = query($sql, $req_id);
    //var_dump($rows);
    if (count($rows) > 0) {
        $errorList[] = "The following documents are still using document type '$description':<br>";
    }
    foreach ($rows as $row) {
        $doc_group = $row["doc_group"];
        $doc_subgroup = $row["doc_subgroup"];
        $doc_name = $row["doc_name"];
        $errorList[] = $doc_group . " - " . $doc_subgroup . " - " . $doc_name . "<br>";
    }
    if (sizeof($errorList) == 0) {
        $sql = "delete from docs_type where id = " . $req_id;
        $result = mysqli_query($handle, $sql);
        if ($result <> false) {
            $message = "Document type '" . $description . "' has been deleted.";
        } else {
            $message = "Unable to delete document type '" . $doc_name . "' - ";
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
echo 'href="../page/docs_type_list.php">Back to document type list</a>';
require "../inc/msg.php";
require "../inc/footer.php";
?>
