<?php
/**
 * Program: docs_type_edit
 * 
 * Edit document type details.
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
if ($_SERVER["REQUEST_METHOD"] <> "POST") {
    include "../inc/db_open.php";
    $docs_type_id = test_input($_GET["id"]);
    //echo "<br>";
    //var_dump($docs_type_id, $_GET);
    if (trim($docs_type_id) == '') {
        die("No document type ID specified - please inform SysAdmin.");
    }
    $_SESSION["selected_docs_type_id"] = $docs_type_id;
    $sql = "select id, description, popi, path ";
    $sql .= "from docs_type ";
    $sql .= "where  id = ?";
    $rows = query($sql, $docs_type_id);
    if (count($rows) == 0) {
        die("No result returned from document types - please advise SysAdmin.");
    }
    //echo "<br>"; 
    //var_dump($sql, $rows);
    $docs_type_id = $rows[0]["id"];
    $description = $rows[0]["description"];
    $popi = $rows[0]["popi"];
    $path = $rows[0]["path"];
    $_SESSION["docs_type_id"] = $docs_type_id;
    $_SESSION["docs_description"] = $description;
    $_SESSION["popi"] = $popi;
    $_SESSION["path"] = $path;
?>
<h1>Edit document type</h1>
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
<input type="hidden" name="id" value="<?php echo $docs_type_id; ?>">
<table cellspacing="5" cellpadding="5">
<tr>
    <td valign="top">Document description</td>
    <td><input size="50" maxlength="50" type="text" name="description" 
        value="<?php echo $description; ?>"></td>
</tr>
<tr>
    <td valign="top">PoPI Status</td>
    <td>
    <select name="popi">
    <?php
    if ($popi == 0) {
        echo '<option value="0" selected>No</option>' . "\n";
    } else {
        echo '<option value="0">No</option>' . "\n";
    }
    if ($popi == "1") {
        echo '<option value="1" selected>Yes</option>' . "\n";
    } else {
        echo '<option value="1">Yes</option>' . "\n";
    }
    ?>
        </select>
    </td>
</tr>
<tr>
    <td valign="top">Document path</td>
    <td><input size="50" maxlength="250" type="text" name="path"
        value="<?php echo $path; ?>"></td>
</tr>
<tr>
    <td colspan=2><input type="submit" name="submit" value="Update" 
        class='w3-button w3-green'/>&nbsp;
        <a class="w3-button w3-green" href="../page/docs_type_list.php">
            Return to document types list</a>
        &nbsp;
    </td>
</tr>
</table>
</form>
    <?php
} else {
    include "../inc/msg.php";
    echo '<h1>Edit a Document Type</h1>';
    $errorList = array();
    $docs_type_id = test_input($_POST["id"]);
    $description = substr(test_input($_POST["description"]), 0, 50);
    $popi = substr(test_input($_POST["popi"]), 0, 1);
    $path = substr(test_input($_POST["path"]), 0, 250);
    if (trim($docs_type_id) == '') {
        $errorList[] = "Document ID is missing - call SysAdmin.";
    }
    if ((trim($popi) == '') or ($docs_type_id == '0')) {
        $errorList[] = "Please select PoPI status.";
    } 
    if (trim($path) == '') {
        $errorList[] = "Please enter a document path.";
    }
    include "../inc/db_open.php";
    $sql = 'select count(*) as kount from docs_type where description = "' . $description . '" ';
    $sql .= 'and id <> ' . $docs_type_id;
    //echo "<br>SQL=$sql";
    $rows = query($sql);
    foreach ($rows as $row) {
        if ($row["kount"] > 0) {
            $errorList[] = "A document type with the same description is already registered.";
        }
    }
    if (sizeof($errorList) == 0) {
        $sql = "update docs_type set description = ?";
        $sql .= ", popi = ?";
        $sql .= ", path = ?";
        $sql .= ", user_id = " . $_SESSION["id"];
        $sql .= " where id = $docs_type_id";
        //echo "<br>SQL = " . $sql . "<br>";
        $rows = query(
            $sql, $description, $popi, $path
        ); 
        echo "Update successful.<br><br>";
        // mysqli_free_result($result);
    } else {
        echo 'The following errors were encountered:<br>';
        echo '<ul>';
        for ($x=0; $x<sizeof($errorList); $x++) {
            echo "<li>$errorList[$x]";
        }
        echo '</ul>';    
    }
    echo '<a href="../page/docs_type_list.php" class="w3-button w3-green">';
    echo 'Back to document types list</a>';
    include "../inc/msg.php";
    include "../inc/footer.php";
}
?>
