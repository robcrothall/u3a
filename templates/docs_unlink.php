<?php
/**
 * Program: docs_unlink
 * 
 * Unlink a person from a document.
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
echo '<h1>Unlink a Document</h1>';
$errorList = [];
if ((!isset($_GET['people_id'])) or (!isset($_GET['docs_id']))) {
    $errorList[] = 'Missing record ID - please inform SysAdmin.';
} else {
    $people_id = test_input($_GET['people_id']);
    $docs_id = test_input($_GET["docs_id"]);
    //$errorList[] = "Key = " . $people_id . "-" . $docs_id;
    include "../inc/db_open.php";
    $sql = "delete from people_docs where people_id = ? and docs_id = ?";
    $rows = query($sql, $people_id, $docs_id);
    //echo "<br>";
    //var_dump($rows);
    if (empty($rows)) {
        $errorList[] = "Link deleted. ";
    } else {
        $errorList[] = "Not able to remove link - Key = " . $people_id . "-" . $docs_id . " - please call SysAdmin.";
    }
    if (sizeof($errorList) > 0) {
        echo 'The following messages were generated:<br>';
        echo '<ul>';
        for ($x=0; $x<sizeof($errorList); $x++) {
            echo "<li>$errorList[$x]";
        }
        echo '</ul>';    
    }
}
echo '<br><br><a class="w3-button w3-green" ';
echo 'href="../page/docs_edit.php?docs_id=' . $docs_id . '">Back to document</a>' . "&nbsp;";
echo '<a class="w3-button w3-green" ';
echo 'href="../page/docs_list.php">Back to document list</a>';
require "../inc/msg.php";
require "../inc/footer.php";
?>
