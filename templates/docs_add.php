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
require "../inc/config.php"; 
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
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" enctype="multipart/form-data">
<tr>
    <td valign="top">Document group</td>
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
        </select>
        <br>
        <input size="50" maxlength="50" type="text" name="new_doc_group">
        <label for="new_doc_group">New document group</label>
    </td>
</tr>
<tr>
    <td valign="top">Document Subgroup</td>
    <td>
    <select name="doc_subgroup">
    <?php
    $rows = query(
        "SELECT distinct doc_subgroup FROM docs " . 
        "order by doc_subgroup"
    );
    echo '<option value="0">--== Please select ==--</option>\n';
    foreach ($rows as $row) {
        echo '<option value="' . $row["doc_subgroup"] . '">';
        echo $row["doc_subgroup"] . "</option>\n";
    }
    ?>
        </select>
        <br>
        <input size="50" maxlength="50" type="text" name="new_doc_subgroup">
        <label for="new_doc_subgroup">New document subgroup</label>
    </td>
</tr>
<tr>
    <td valign="top">Document type</td>
    <td>
    <select name="docs_type">
    <?php
    $rows = query(
        "SELECT id, description FROM docs_type " . 
        "order by description"
    );
    echo '<option value="0">--== Please select ==--</option>\n';
    foreach ($rows as $row) {
        echo '<option value="' . $row["id"] . '">';
        echo $row["description"] . "</option>\n";
    }
    ?>
        </select>
    </td>
</tr>
<tr>
    <td valign="top">Displayed name</td>
    <td><input size="50" maxlength="50" type="text" name="doc_name"></td>
</tr>
<tr>
    <td valign="top">Version</td>
    <td><input size="50" maxlength="50" type="text" name="doc_version"></td>
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
    value="<?php echo date('Y-m-d', $date); ?>" />
    </td>
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
        <a class="w3-button w3-green" href="../page/docs_list.php">
            Return to Document List</a>&nbsp;
    </td>
</tr>
</form>
</table>
    <?php
} else {
    include "../inc/msg.php";
    echo '<h1>Add a Document</h1>';
    $_SESSION["selected_doc"] = 0;
    $errorList = array();
    $doc_group = test_input($_POST["doc_group"]);
    $new_doc_group = test_input($_POST["new_doc_group"]);
    if (strlen($new_doc_group) > 0) {
        $doc_group = $new_doc_group;
    }
    $doc_subgroup = test_input($_POST["doc_subgroup"]);
    $new_doc_subgroup = test_input($_POST["new_doc_subgroup"]);
    if (strlen($new_doc_subgroup) > 0) {
        $doc_subgroup = $new_doc_subgroup;
    }
    $docs_type = test_input($_POST["docs_type"]);
    //$new_docs_type = test_input($_POST["new_docs_type"]);
    //if (strlen($new_docs_type) > 0) {
        //$docs_type = $new_docs_type;
    //}
    $doc_name = test_input($_POST["doc_name"]);
    $doc_version = test_input($_POST["doc_version"]);
    //$doc_author = test_input($_POST["doc_author"]);
    //$doc_file = test_input($_POST["doc_file"]);
    $submitted = test_input($_POST["submitted"]);
    $approved = test_input($_POST["approved"]);
    $review = test_input($_POST["review"]) . "-01";
    $user_id = $_SESSION["id"];
    $sql = "select path from docs_type where id = ?";
    $rows = query($sql, $docs_type);
    //echo "<br> Path is: ";
    //var_dump($rows);
    //$doc_file_path  = '../data/' . $docs_type . '/';
    $doc_file_path  = $rows[0]["path"] . '/';
    $doc_file = basename($_FILES["doc_file"]["name"]);
    //echo "<br> doc_file is $doc_file";
    if (trim($doc_name) == '') {
        $errorList[] = "Please enter a document name.";
    }
    include "../inc/db_open.php";
    $sql = 'select * from docs d, docs_type t where doc_name = "' . $doc_name;
    $sql .= '" and doc_group = "' . $doc_group;
    $sql .= '" and doc_subgroup = "' . $doc_subgroup;
    $sql .= '" and doc_version = "' . $doc_version;
    //$sql .= '" and doc_author = "' . $doc_author;
    $sql .= '" and doc_type_id = t.id ';
    $sql .= ' and t.id = ' . $docs_type;
    //echo "<br>";
    //echo $sql;
    $result = mysqli_query($handle, $sql)
        or die("Error in query: $sql. " . mysqli_error($handle));
    //echo "<br>";
    //var_dump($result);
    foreach ($handle->query($sql) as $row) {
        $errorList[] = "This document is already present. ID = " . $row["id"];
    }
    if (strlen($doc_group) == 0) {
        $errorList[] = "Please select a document group.  ";
    }
    //if (strlen($doc_subgroup) == 0) {
        //$errorList[] = "Please select a document subgroup.  ";
    //}
    //if (strlen($doc_version) == 0) {
        //$errorList[] = "Please select a document version.  ";
    //}
    //if (strlen($doc_author) == 0) {
        //$errorList[] = "Please select a document author.  ";
    //}
    if (strlen($docs_type) == 0) {
        $errorList[] = "Please select a document type.  ";
    }
    if (strlen($doc_name) == 0) {
        $errorList[] = "Please enter a document name.  ";
    }
    if (!file_exists($doc_file_path)) {
        echo "<br>Doc file path: $doc_file_path";
        mkdir($doc_file_path, 0774, true);
    }
    //echo "<br>";
    //var_dump($_FILES);
    //echo "<br>";
    //echo basename($_FILES["doc_file"]["name"]);
    $new_doc_file = basename($_FILES["doc_file"]["name"]);
    $new_doc_file = str_replace(" ", "_", $new_doc_file);
    $sql = "select * from docs where doc_path = ? and doc_file = ?";
    $rows = query($sql, $doc_file_path, $new_doc_file);
    foreach ($rows as $row) {
        $errorList[] = "File previously uploaded as $doc_group - $doc_subgroup - $doc_name - $doc_version";
    }
    $last_id = 0;
    if (sizeof($errorList) == 0) {
        $full_doc_file_path = $doc_file_path . $new_doc_file;
        //echo "<br>";
        //echo "Full doc file path = " . $full_doc_file_path;
        move_uploaded_file($_FILES["doc_file"]["tmp_name"], $full_doc_file_path);
        //move_uploaded_file($_FILES["doc_file"]["tmp_name"], $doc_file_path . $doc_file);
        //move_uploaded_file($_FILES["doc_file"]["tmp_name"], "../data/aaaaa.pdf");
        $sql = "insert into docs (doc_group, doc_subgroup, doc_version, ";
        $sql .= "doc_type_id, doc_name, doc_path, doc_file, ";
        $sql .= "submitted, approved, review, ";
        $sql .= "user_id) values ('";
        $sql .= $doc_group . "', '" . $doc_subgroup . "', '" . $doc_version . "', ";
        $sql .= $docs_type . ", '" . $doc_name . "', '";
        $sql .= $doc_file_path . "', '" . $new_doc_file . "', '" . $submitted . "', '" . $approved . "', '";
        $sql .= $review . "', ";
        $sql .= $user_id . ")";
        ////echo "<br>" . $sql . "</br>";
        $result = mysqli_query($handle, $sql) 
            or die("Error in query: $sql. " . mysqli_error($handle));
        $last_id = mysqli_insert_id($handle);
        echo "<br>Document added successfully.  ID = $last_id <br><br>";
        // mysqli_free_result($result); 
    } else {
        echo '<br>The following errors were encountered:<br>';
        echo '<ul>';
        for ($x=0; $x<sizeof($errorList); $x++) {
            echo "<li>$errorList[$x]";
        }
        echo '</ul>';    
    }
    echo '<a class="w3-button w3-green" href="../page/docs_list.php">';
    echo 'Back to Documents List</a>&nbsp;';
    if ($last_id > 0) {
        $_SESSION["selected_doc"] = $last_id;
        echo '<a class="w3-button w3-green" href="../page/docs_link.php">';
        echo 'Link Document to People</a>';
        }
    include "../inc/msg.php";
    include "../inc/footer.php";
}
?>
