<?php
/**
 * Program docs_list
 * 
 * List publicly accessible documents 
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
include "../inc/db_open.php";
//Initialise $_SESSION values
if (!isset($_SESSION["DOC_GROUP"])) {
    $_SESSION["DOC_GROUP"] = "any";
}
if (!isset($_SESSION["DOC_SUBGROUP"])) {
    $_SESSION["DOC_SUBGROUP"] = "any";
}
if (!isset($_SESSION["DOC_TYPE"])) {
    $_SESSION["DOC_TYPE"] = "any";
}
if (!isset($_SESSION["DOC_NAME"])) {
    $_SESSION["DOC_NAME"] = "any";
}
if (!isset($_SESSION["DOC_VERSION"])) {
    $_SESSION["DOC_VERSION"] = "any";
}
//Update $_SESSION values from $_POST
if (isset($_POST["DOC_GROUP"])) {
    $_SESSION["DOC_GROUP"] = $_POST["DOC_GROUP"];
}
if (isset($_POST["DOC_SUBGROUP"])) {
    $_SESSION["DOC_SUBGROUP"] = $_POST["DOC_SUBGROUP"];
}
if (isset($_POST["DOC_TYPE"])) {
    $_SESSION["DOC_TYPE"] = $_POST["DOC_TYPE"];
}
if (isset($_POST["DOC_NAME"])) {
    $_SESSION["DOC_NAME"] = $_POST["DOC_NAME"];
}
if (isset($_POST["DOC_VERSION"])) {
    $_SESSION["DOC_VERSION"] = $_POST["DOC_VERSION"];
}
$subset = "";
$message = "";
?>
<h1>Available documents</h1>
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
<?php
if (check_role("DOCS") or check_role("ADMIN")) {
    echo '<a class="w3-button w3-green" href="../page/docs_add.php">Add a Document</a>&nbsp;';
}
echo "<input type='submit' value='Refresh' class='w3-button w3-green'/>&nbsp;";
//echo '<label for="DOC_GROUP">Doc Group</label>';
echo '<select name="DOC_GROUP" id="DOC_GROUP">' . "\n";
$selected = "";
if ($_SESSION["DOC_GROUP"] == "any") {
    $selected = " selected";
}
echo '<option value="any"' . $selected . ">All Doc Groups</option>\n";
$selected = "";
$rows = query("SELECT distinct doc_group FROM docs order by doc_group");
foreach ($rows as $row) {
    if ($row["doc_group"] == $_SESSION["DOC_GROUP"]) {
        $selected = " selected";
        $subset .= ' and doc_group="' . $row["doc_group"] . '"';
    } else {
        $selected = "";
    }
    echo '<option value="' . $row["doc_group"] . '"' . $selected . ">";
    //echo $row["doc_group"] . " - " . $selected . 
    //$_SESSION["DOC_GROUP"] . "</option>\n";
    echo $row["doc_group"] . "</option>\n";
}
echo "</select>&nbsp;";
echo '<select name="DOC_SUBGROUP" id="DOC_SUBGROUP">' . "\n";
$selected = "";
if ($_SESSION["DOC_SUBGROUP"] == "any") {
    $selected = " selected";
}
echo '<option value="any"' . $selected . ">All Doc Sub-Groups</option>\n";
$selected = "";
$rows = query("SELECT distinct doc_subgroup FROM docs order by doc_subgroup");
foreach ($rows as $row) {
    if ($row["doc_subgroup"] == $_SESSION["DOC_SUBGROUP"]) {
        $selected = " selected";
        $subset .= ' and doc_subgroup="' . $row["doc_subgroup"] . '"';
    } else {
        $selected = "";
    }
    echo '<option value="' . $row["doc_subgroup"] . '"' . $selected . ">";
    //echo $row["doc_group"] . " - " . $selected . 
    //$_SESSION["DOC_GROUP"] . "</option>\n";
    echo $row["doc_subgroup"] . "</option>\n";
}
echo "</select>&nbsp;";
echo '<select name="DOC_TYPE" id="DOC_TYPE">' . "\n";
$selected = "";
if ($_SESSION["DOC_TYPE"] == "any") {
    $selected = " selected";
}
echo '<option value="any"' . $selected . ">All Doc Types</option>\n";
$selected = "";
$rows = query("SELECT distinct t.id, t.description FROM docs_type t order by t.description");
foreach ($rows as $row) {
    if ($row["description"] == $_SESSION["DOC_TYPE"]) {
        $selected = " selected";
        $subset .= ' and doc_type_id=' . $row["id"];
    } else {
        $selected = "";
    }
    echo '<option value="' . $row["description"] . '"' . $selected . ">";
    //echo $row["doc_group"] . " - " . $selected . 
    //$_SESSION["DOC_GROUP"] . "</option>\n";
    echo $row["description"] . "</option>\n";
}
echo "</select>&nbsp;";
echo '<select name="DOC_NAME" id="DOC_NAME">' . "\n";
$selected = "";
if ($_SESSION["DOC_NAME"] == "any") {
    $selected = " selected";
}
echo '<option value="any"' . $selected . ">All Doc Names</option>\n";
$selected = "";
$rows = query("SELECT distinct doc_name FROM docs order by doc_name");
foreach ($rows as $row) {
    if ($row["doc_name"] == $_SESSION["DOC_NAME"]) {
        $selected = " selected";
        $subset .= ' and doc_name like "' . $row["doc_name"] . '"';
    } else {
        $selected = "";
    }
    echo '<option value="' . $row["doc_name"] . '"' . $selected . ">";
    //echo $row["doc_group"] . " - " . $selected . 
    //$_SESSION["DOC_GROUP"] . "</option>\n";
    echo $row["doc_name"] . "</option>\n";
}
echo "</select>&nbsp;";
echo '<select name="DOC_VERSION" id="DOC_VERSION">' . "\n";
$selected = "";
if ($_SESSION["DOC_VERSION"] == "any") {
    $selected = " selected";
}
echo '<option value="any"' . $selected . ">All Doc Versions</option>\n";
$selected = "";
$rows = query("SELECT distinct doc_version FROM docs order by doc_version");
foreach ($rows as $row) {
    if ($row["doc_version"] == $_SESSION["DOC_VERSION"]) {
        $selected = " selected";
        $subset .= ' and doc_version="' . $row["doc_version"] . '"';
    } else {
        $selected = "";
    }
    echo '<option value="' . $row["doc_version"] . '"' . $selected . ">";
    //echo $row["doc_group"] . " - " . $selected . 
    //$_SESSION["DOC_GROUP"] . "</option>\n";
    echo $row["doc_version"] . "</option>\n";
}
echo "</select>&nbsp;";

?>
<table cellspacing="1" cellpadding="1">
<tr>
    <th>Document group</th>
    <th>Sub-group</th>
    <th>Type</th>
    <th>Document Name</th>
    <th>Version</th>
    <?php
    if (check_role("DOCS")) {
        echo '<th>Submitted</th>';
        echo '<th>Approved</th>';
        echo '<th>Review Date</th>';
        echo '<th>Action</th>';
    }
    ?>
</tr>
    <?php
    $sql = "SELECT d.id as docs_id, doc_group, doc_subgroup, doc_name, doc_version, " .
        "doc_path, doc_file, submitted, approved, review, t.description, t.id, t.role " . 
        "FROM docs d, docs_type t " . 
        "where d.doc_type_id = t.id ";
    $sql .= $subset;
    //echo "<br>";
    //var_dump($sql);
    //echo "<br>";
    //$message .= $subset;
    //$sql .= " order by doc_group, doc_subgroup, t.description, submitted desc, doc_name, doc_version ";
    $sql .= " order by doc_group, doc_subgroup, t.description, doc_name, submitted desc, doc_version ";
    //$message .= " | " . $sql;

    $rows = query($sql);
    //echo "<br>";
    //var_dump($rows);
    //echo "<br>";
    $prev_doc_group = "none";
    $prev_doc_subgroup = "none";
    $prev_description = "none";
    $prev_doc_name = "none";
    $prev_doc_version = "none";
    foreach ($rows as $row) {
        if (!empty($row["role"])) {
            if (!check_role($row["role"])) {
                continue;
            }
        }
        echo '<tr><td>';
        if ($row["doc_group"] <> $prev_doc_group) {
            echo $row["doc_group"];
            $prev_doc_group = $row["doc_group"];
            $prev_doc_subgroup = "none";
            $prev_description = "none";
            $prev_doc_name = "none";
            $prev_doc_version = "none";
                } else {
            echo " ";
        }
        echo '</td><td>';
        if ($row["doc_subgroup"] <> $prev_doc_subgroup) {
            echo $row["doc_subgroup"];
            $prev_doc_subgroup = $row["doc_subgroup"];
            $prev_description = "none";
            $prev_doc_name = "none";
            $prev_doc_version = "none";
        } else {
            echo " ";
        }
        echo '</td><td>';
        if ($row["description"] <> $prev_description) {
            echo $row["description"];
            $prev_description = $row["description"];
            $prev_doc_name = "none";
            $prev_doc_version = "none";
        } else {
            echo " ";
        }
        echo '</td><td>';
        echo '<a href="' . $row["doc_path"] . $row["doc_file"];
        echo '" target="_blank">';
        echo $row["doc_name"] . '</a>';
        echo '</td>';
        echo '<td>' . $row["doc_version"] . '</td>';
        if (check_role("DOCS")) {
            echo '<td>' . $row["submitted"] . '</td>';
            echo '<td>' . $row["approved"] . '</td>';
            echo '<td>' . $row["review"] . '</td>';
            echo '<td>';
            echo '<a class="w3-button w3-green" href="../page/docs_edit.php?docs_id=';
            echo $row['docs_id'] . '">Update</a>';
            echo '<a class="w3-button w3-red" href="../page/docs_delete.php?docs_id=';
            echo $row['docs_id'] . '">Delete</a>';
            echo '</td>';
        }
        echo '</tr>' . "\n";
    }
    ?>
</form>
</table>
<?php
include "../inc/msg.php";
include "../inc/footer.php";
?>
