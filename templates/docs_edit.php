<?php
/**
 * Program: docs_edit
 * 
 * Edit document details.
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
    $id = test_input($_GET["docs_id"]);
    if (trim($id) == '') {
        die("No document ID specified - please inform SysAdmin.");
    }
    $_SESSION["selected_doc"] = $id;
    $sql = "select a.id, doc_group, doc_subgroup, doc_type_id, doc_name, doc_version, ";
    $sql .= "doc_path, doc_file, submitted, approved, review ";
    $sql .= "from docs a ";
    $sql .= "where  id = ?";
    //echo "<br>";
    //var_dump($sql, $id);
    //echo "<br>";
    $rows = query($sql, $id);
    if (count($rows) == 0) {
        die("No result returned from documents - please advise SysAdmin.");
    }
    //echo "<br>"; 
    //var_dump($sql, $rows);
    $doc_id = $rows[0]["id"];
    $doc_group = $rows[0]["doc_group"];
    $doc_subgroup = $rows[0]["doc_subgroup"];
    $doc_type_id = $rows[0]["doc_type_id"];
    $doc_name = $rows[0]["doc_name"];
    $doc_version = $rows[0]["doc_version"];
    //$doc_author = $rows[0]["doc_author"];
    $doc_path = $rows[0]["doc_path"];
    $doc_file = $rows[0]["doc_file"];
    $submitted = $rows[0]["submitted"];
    $approved = $rows[0]["approved"];
    $review = $rows[0]["review"];
    //echo "<br>";
    //var_dump($doc_id, $doc_name, $doc_group, $doc_subgroup);
    $_SESSION["doc_id"] = $doc_id;
    $_SESSION["doc_group"] = $doc_group;
    $_SESSION["doc_subgroup"] = $doc_subgroup;
    $_SESSION["doc_type_id"] = $doc_type_id;
    $_SESSION["doc_name"] = $doc_name;
    $_SESSION["doc_version"] = $doc_version;
    //$_SESSION["doc_author"] = $doc_author;
    $_SESSION["doc_path"] = $doc_path;
    $_SESSION["doc_file"] = $doc_file;
    $_SESSION["submitted"] = $submitted;
    $_SESSION["approved"] = $approved;
    $_SESSION["review"] = $review;
?>
<h1>Edit document</h1>
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
<input type="hidden" name="id" value="<?php echo $id; ?>">
<table cellspacing="5" cellpadding="5">
<tr>
    <td colspan=2><input type="submit" name="submit" value="Update" 
        class='w3-button w3-green'/>&nbsp;
        <?php
        $_SESSION["selected_doc"] = $doc_id;
        echo '<a class="w3-button w3-green" href="../page/docs_link.php">';
        echo 'Link (or unlink) Document and People</a>' . "&nbsp;";
        ?>
        <a class="w3-button w3-green" href="../page/docs_list.php">
            Return to document list</a>
        &nbsp;
    </td>
</tr>
<tr>
    <td valign="top">Document group</td>
    <td>
    <select name="doc_group" required autofocus>
    <?php
    $selected = '';
    $rows = query(
        "SELECT distinct doc_group FROM docs " . 
        "order by doc_group"
    );
    echo '<option value="0" selected>--== Please select ==--</option>' . "\n";
    foreach ($rows as $row) {
        if (!empty($doc_group)) {
            if ($row["doc_group"] == $doc_group) {
                $selected = " selected";
            } else {
                $selected = "";
            }
        }
        echo '<option value="' . $row["doc_group"] . '"' . $selected . '>';
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
    $selected = '';
    $rows = query(
        "SELECT distinct doc_subgroup FROM docs " . 
        "order by doc_subgroup"
    );
    echo '<option value="0" selected>--== Please select ==--</option>\n';
    foreach ($rows as $row) {
        if (!empty($doc_subgroup)) {
            if ($row["doc_subgroup"] == $doc_subgroup) {
                $selected = " selected";
            } else {
                $selected = "";
            }
        }
        echo '<option value="' . $row["doc_subgroup"] . '"' . $selected . '>';
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
    <select name="doc_type_id">
    <?php
    $selected = '';
    $rows = query(
        "SELECT id, description FROM docs_type " . 
        "order by description"
    );
    echo '<option value="0" selected>--== Please select ==--</option>\n';
    foreach ($rows as $row) {
        if ($row["id"] == $doc_type_id) {
            $selected = " selected";
        } else {
            $selected = "";
        }
        echo '<option value="' . $row["id"] . '"' . $selected . '>';
        echo $row["description"] . "</option>\n";
    }
    ?>
        </select>
    </td>
</tr>
<tr>
    <td valign="top">Displayed name</td>
    <td><input size="50" maxlength="50" type="text" name="doc_name" 
        value="<?php echo $doc_name; ?>"></td>
</tr>
<tr>
    <td valign="top">Version</td>
    <td><input size="50" maxlength="50" type="text" name="doc_version"
        value="<?php echo $doc_version; ?>"></td>
</tr>
    <?php
    $date=strtotime("Today");
    $reviewdate=strtotime("+1 Year", $date);
    ?> 
    <tr>
    <td valign="top">Date submitted</td>
    <td><input type="date" name="submitted" class="form-control" size="10"
        value="<?php echo $submitted; ?>" /></td>
</tr>
<tr>
    <td valign="top">Date approved</td>
    <td><input type="date" name="approved" class="form-control" size="10"
    value="<?php echo $approved; ?>" />
    </td>
</tr>
<tr>
    <td valign="top">Date to be reviewed</td>
    <td><input type="date" name="review" class="form-control" size="7"
    value="<?php echo $review; ?>" /></td>
</tr>
<tr>
    <td valign="top">Document path</td>
    <td><input size="50" maxlength="50" type="text" name="doc_path"
        value="<?php echo $doc_path; ?>"></td>
</tr>
<tr>
    <td valign="top">Document file</td>
    <td><input size="50" maxlength="50" type="text" name="doc_file"
        value="<?php echo $doc_file; ?>"></td>
</tr>
<tr>
    <td colspan=2><input type="submit" name="submit" value="Update" 
        class='w3-button w3-green'/>&nbsp;
        <?php
        $_SESSION["selected_doc"] = $doc_id;
        echo '<a class="w3-button w3-green" href="../page/docs_link.php">';
        echo 'Link (or unlink) Document and People</a>' . "&nbsp;";
        ?>
        <a class="w3-button w3-green" href="../page/docs_list.php">
            Return to document list</a>
        &nbsp;
    </td>
</tr>
</table>
</form>
    <?php
} else {
    include "../inc/msg.php";
    echo '<h1>Edit a Document</h1>';
    $errorList = array();
    $doc_id = test_input($_POST["id"]);
    $doc_group = substr(test_input($_POST["doc_group"]), 0, 50);
    $doc_subgroup = substr(test_input($_POST["doc_subgroup"]), 0, 50);
    $doc_type_id = test_input($_POST["doc_type_id"]);
    $doc_name =substr(test_input($_POST["doc_name"]), 0, 50);
    $doc_version =substr(test_input($_POST["doc_version"]), 0, 20);
    //$doc_author =substr(test_input($_POST["doc_author"]), 0, 50);
    $doc_path =substr(test_input($_POST["doc_path"]), 0, 250);
    $doc_file =substr(test_input($_POST["doc_file"]), 0, 250);
    $submitted = test_input($_POST["submitted"]);
    $approved = test_input($_POST["approved"]);
    $review = test_input($_POST["review"]);
    $new_doc_group = test_input($_POST["new_doc_group"]);
    $new_doc_subgroup = test_input($_POST["new_doc_subgroup"]);
    if (strlen($new_doc_group) > 0) {
        $doc_group = $new_doc_group;
    }
    if (strlen($new_doc_subgroup) > 0) {
        $doc_subgroup = $new_doc_subgroup;
    }
    if (trim($doc_id) == '') {
        $errorList[] = "Document ID is missing - call SysAdmin.";
    }
    if ((trim($doc_group) == '') or ($doc_group == '0')) {
        $errorList[] = "Please select a document group.";
    } 
    //if ((trim($doc_subgroup) == '') or ($doc_subgroup == '0')) {
        //$errorList[] = "Please select a document subgroup.";
    //} 
    if ((trim($doc_type_id) == '') or ($doc_type_id == '0')) {
        $errorList[] = "Please select a document type.";
    } 
    if (trim($doc_name) == '') {
        $errorList[] = "Please enter a document name.";
    }
    //if (trim($doc_version) == '') {
        //$errorList[] = "Please enter a document version number.";
    //}
    if (trim($doc_path) == '') {
        $errorList[] = "Please enter the document path.";
    }
    if (trim($doc_file) == '') {
        $errorList[] = "Please enter the document file name.";
    }
    include "../inc/db_open.php";
    $sql = 'select count(*) as kount from docs where doc_group = "' . $doc_group . '" ';
    $sql .= 'and doc_subgroup = "' . $doc_subgroup . '" ';
    $sql .= 'and doc_type_id = ' . $doc_type_id . ' ';
    $sql .= 'and doc_name = "' . $doc_name . '" ';
    $sql .= 'and doc_version = "' . $doc_version . '" ';
    $sql .= 'and id <> ' . $doc_id;
    //echo "<br>SQL=$sql";
    $rows = query($sql);
    foreach ($rows as $row) {
        if ($row["kount"] > 0) {
            $errorList[] = "A document with the same group, subgroup, type, name, and version is already registered.";
        }
    }
    if (sizeof($errorList) == 0) {
        $sql = "update docs set doc_group= ?";
        $sql .= ", doc_subgroup = ?";
        $sql .= ", doc_type_id = ?";
        $sql .= ", doc_name = ?";
        $sql .= ", doc_version = ?";
        //$sql .= ", doc_author = ?";
        $sql .= ", doc_path = ?";
        $sql .= ", doc_file = ?";
        $sql .= ", submitted = ?";
        $sql .= ", approved = ?";
        $sql .= ", review = ?";
        $sql .= ", user_id = " . $_SESSION["id"];
        $sql .= " where id = $doc_id";
        $rows = query(
            $sql, $doc_group, $doc_subgroup, $doc_type_id, $doc_name, $doc_version,
            $doc_path, $doc_file, $submitted, $approved, $review
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
    echo '<a href="../page/docs_list.php" class="w3-button w3-green">';
    echo 'Back to documents list</a>' . "&nbsp;";
    $_SESSION["selected_doc"] = $doc_id;
    echo '<a class="w3-button w3-green" href="../page/docs_link.php">';
    echo 'Link Document to People</a>';
    include "../inc/msg.php";
    include "../inc/footer.php";
}
?>
