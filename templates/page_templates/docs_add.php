<?php
/**
 * Program docs_add
 * 
 * Add documents to the assets directory and update docs table
 * 
 * PHP version 7.1
 * 
 * @category Template
 * @package  Sample
 * @author   "Rob Crothall" <rob@crothall.co.za>
 * @license  GPL 1.0 or later
 * @version  GIT: <git_id>
 * @link     http://www.sprv.co.za
 */
require "../conf/config.php"; 
$_SESSION["module"] = $_SERVER["PHP_SELF"];
require "../inc/head.php";
require "../inc/body.php";
require "../inc/menu.php";
require "../inc/msg.php";
if ($_SERVER["REQUEST_METHOD"] <> "POST") {
    include "../inc/db_open.php";
    ?>
<h1>Add a document</h1>
<table cellspacing="5" cellpadding="5">
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
<tr>
    <td valign="top" align="right">Document group</td>
    <td>
    <select name="doc_group">
    <?php
    $rows = query(
        "SELECT distinct doc_group FROM docs " . 
        "order by doc_group"
    );
    echo '<option value="0">--== Please select ==--</option>\n';
    foreach ($rows as $row) {
        echo '<option value="' . $row["doc_group"] . '">';
        echo $row["doc_group"] . "</option>\n";
    }
    ?>
        </select>&nbsp;&nbsp;
        <input size="50" maxlength="50" type="text" name="new_doc_group" 
            placeholder="New document group">
    </td>
</tr>
<tr>
    <td valign="top" align="right">Document sub-group</td>
    <td>
    <select name="doc_subgroup">
    <?php
    $rows = query(
        "SELECT distinct doc_subgroup FROM docs " . 
        "order by doc_group"
    );
    echo '<option value="0">--== Please select ==--</option>\n';
    foreach ($rows as $row) {
        echo '<option value="' . $row["doc_subgroup"] . '">';
        echo $row["doc_subgroup"] . "</option>\n";
    }
    ?>
        </select>&nbsp;&nbsp;
        <input size="50" maxlength="50" type="text" name="new_doc_sub_group" 
            placeholder="New document sub-group">
    </td>
</tr>
<tr>
    <td valign="top">Displayed name</td>
    <td><input size="50" maxlength="50" type="text" 
        name="doc_name"></td>
</tr>
    <?php
    $date=strtotime("Today");
    $reviewdate=strtotime("+1 Year", $date);
    ?> 
    <tr>
    <td valign="top">Date submitted</td>
    <td><input type="text" name="submitted" class="form-control" size="10"
    value="<?php echo date('Y-m-d', $date); ?>" /></td>
</tr>
<tr>
    <td valign="top">Date approved</td>
    <td><input type="text" name="approved" class="form-control" size="10"
    value="<?php echo date('Y-m-d', $date); ?>" /></td>
</tr>
<tr>
    <td valign="top">Date to be reviewed</td>
    <td><input type="text" name="review" class="form-control" size="7"
    value="<?php echo date('Y-m', $reviewdate); ?>" /></td>
</tr>
<tr>
    <td><label for="doc_file">PDF Document file: </label></td>
    <td><input type="file" id="doc_file" name="doc_file" accept=".pdf"></td>
</tr>
<tr>
    <td colspan=2>
        <input type="submit" name="submit" value="Add" 
            class="w3-button w3-green"/>&nbsp;
        <a class="w3-button w3-green" href="../view/docs_list.php">
            Return to Document List</a>&nbsp;
    </td>
</tr>
</form>
</table>
    <?php
} else {
    include "../assets/inc/msg.php";
    echo '<h1>Add a Document</h1>';
    $errorList = array();
    $doc_group = test_input($_POST["doc_group"]);
    $new_doc_group = test_input($_POST["new_doc_group"]);
    $doc_subgroup = test_input($_POST["doc_subgroup"]);
    $new_doc_sub_group = test_input($_POST["new_doc_sub_group"]);
    $doc_name = test_input($_POST["doc_name"]);
    $doc_file = test_input($_POST["doc_file"]);
    $submitted = test_input($_POST["submitted"]);
    $approved = test_input($_POST["approved"]);
    $review = test_input($_POST["review"]);
    $user_id = $_SESSION["id"];
    if (trim($doc_name) == '') {
        $errorList[] = "Please enter a document name.";
    }
    include "../inc/db_open.php";
    //$sql = 'select * from docs where doc_name = "';
    //$sql .= $doc_name . '" and doc_group = "';
    //$sql .= $doc_group . '" and doc_subgroup = "';
    //$sql .= $doc_subgroup . '"';
    //$result = mysqli_query($handle, $sql)
    //    or die("Error in query: $sql. " . mysqli_error($handle));
    //foreach ($handle->query($sql) as $row) {
        // Archive the old record and file
    //}
    if (!empty($new_doc_group)) {
        $doc_group = $new_doc_group;
    }
    if ($doc_group == "--== Please select ==--") {
        $errorList[] = "Please select a document group.  ";
    }
    if (!empty($new_doc_sub_group)) {
        $doc_subgroup = $new_doc_sub_group;
    }
    if ($doc_subgroup == "--== Please select ==--") {
        $errorList[] = "Please select a document sub-group.  ";
    }
    if (empty($doc_name)) {
        $errorList[] = "Please enter a document name.  ";
    }
    // Validate the dates ----------------------------------------------------
    if (sizeof($errorList) == 0) {
        $sql = "insert into docs (doc_group, doc_subgroup, doc_name, doc_file, ";
        $sql .= "submitted, approved, review, ";
        $sql .= "user_id) values ('";
        $sql .= $doc_group . "', '" . $doc_subgroup . "', '" . $doc_name . "', '";
        $sql .= $doc_file . "', '" . $submitted . "', '" . $approved . "', '";
        $sql .= $review . "', ";
        $sql .= $user_id . ")";
        echo "<br>" . $sql . "</br>";
        $result = mysqli_query($handle, $sql) 
            or die("Error in query: $sql. " . mysqli_error($handle));
        echo "Document added successfully.<br><br>";
        // mysqli_free_result($result);
    } else {
        echo 'The following errors were encountered:<br>';
        echo '<ul>';
        for ($x=0; $x<sizeof($errorList); $x++) {
            echo "<li>$errorList[$x]";
        }
        echo '</ul>';    
    }
    echo '<a class="w3-button w3-green" href="../page/doc_list.php">';
    echo 'Back to Document List</a>';
    include "../inc/msg.php";
    include "../inc/footer.php";
}
?>
