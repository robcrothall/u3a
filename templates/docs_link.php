<?php
/**
 * Program docs_link
 * 
 * Link documents to people
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
$doc_id = $_SESSION["selected_doc"];
if ($_SERVER["REQUEST_METHOD"] <> "POST") {
    $sql = "select doc_name from docs where id = ?";
    $rows = query($sql, $doc_id);
    $doc_name = $rows[0]["doc_name"];
    ?>
<h1>Link a person to a document</h1>
<table cellspacing="5" cellpadding="5">
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST"">
<tr>
    <td colspan=2>
        <input type="submit" name="submit" value="Submit" 
            class="w3-button w3-green"/>&nbsp;
        <a class="w3-button w3-green" href="../page/docs_list.php">
            Return to Document List</a>&nbsp;
    </td>
</tr>
<tr>
    <td valign="top">Document name</td>
    <td><input size="50" maxlength="50" type="text" name="doc_name" value="<?php echo $doc_name; ?>"></td>
</tr>
<tr>
    <td valign="top">Already linked</td>
    <td valign="top">
        <?php
            $sql = "select id, surname, first_name, given_name, docs_role ";
            $sql .= "from people a, people_docs b ";
            $sql .= "where b.people_id = a.id and b.docs_id = ? ";
            $sql .= "order by surname, first_name, given_name ";
            $rows = query($sql, $doc_id);
            foreach($rows as $row) {
                $full_name = $row["surname"] . ", " . $row["first_name"];
                if (!empty($row["given_name"])) {
                    $full_name .= ' (' . $row["given_name"] . ')';
                }
                echo '<a href="../page/docs_unlink.php?people_id=' . $row["id"] . "&docs_id=$doc_id" . '">Unlink</a> - '; 
                echo '<a href="../page/people_read.php?id=';
                echo $row['id'] . '">' . $full_name . '</a>' . '&nbsp;';
                if (!empty($row["docs_role"])) {
                    echo " - " . $row["docs_role"];
                }
                echo "<br>\n";
            }
        ?>
    </td>
</tr>
<tr>
    <td valign="top">Person</td>
    <td>
        <select name="linked_person">
            <option value="0">--== Please select ==--</option>
            <?php
            $sql = "select id, surname, first_name, given_name ";
            $sql .= "from people ";
            $sql .= "order by surname, first_name, given_name ";
            $rows = query($sql);
            foreach($rows as $row) {
                $full_name = $row["surname"] . ", " . $row["first_name"];
                if (!empty($row["given_name"])) {
                    $full_name .= " (" . $row["given_name"] . ")";
                }
                echo '<option value="' . $row["id"] . '">';
                echo $full_name . "</option>/n";
            }
            ?>
        </select>
    </td>
</tr>
<tr>
    <td valign="top">Document role</td>
    <td><input size="20" maxlength="20" type="text" name="docs_role">
    </td>
</tr>
<tr>
    <td colspan=2>
        <input type="submit" name="submit" value="Submit" 
            class="w3-button w3-green"/>&nbsp;
        <a class="w3-button w3-green" href="../page/docs_list.php">
            Return to Document List</a>&nbsp;
    </td>
</tr>
</form>
</table>
    <?php
} else {
    //include "../inc/msg.php";
    echo '<h1>Link a person to a document</h1>';
    $errorList = array();
    $linked_person = test_input($_POST["linked_person"]);
    if ($linked_person == "0") {
        $errorList[] = "Please select a person to link to the document. ";
    }
    $sql = "select * from people_docs where people_id = ? and docs_id = ?";
    $rows = query($sql, $linked_person, $doc_id);
    if (count($rows) > 0) {
        $sql = "select surname, first_name, given_name from people where id = ?";
        $rows = query($sql, $linked_person);
        $full_name = $rows[0]["surname"] . ", " . $rows[0]["first_name"];
        if (!empty($rows[0]["given_name"])) {
            $full_name .= " (" . $rows[0]["given_name"] . ")";
        }
        $errorList[] = $full_name . " is already linked to the document. ";
    }
    $docs_role = test_input($_POST["docs_role"]);
    if (sizeof($errorList) == 0) {
        $selected_doc = $_SESSION["selected_doc"];
        $sql = "insert into people_docs (people_id, docs_id, docs_role) values (";
        $sql .= "$linked_person, $selected_doc, '$docs_role') ";
        $sql .= "on duplicate key update docs_role = '$docs_role'";
        $result = mysqli_query($handle, $sql)
            or die("Error in query: $sql. " . mysqli_error($handle));
        //echo "<br>";
        //var_dump($result);
        echo "<br>Link added successfully.<br><br>";
    } else {
        echo '<br>The following errors were encountered:<br>';
        echo '<ul>';
        for ($x=0; $x<sizeof($errorList); $x++) {
            echo "<li>$errorList[$x]";
        }
        echo '</ul>';    
    }
    echo '<br><a class="w3-button w3-green" href="../page/docs_list.php">';
    echo 'Back to Documents List</a>&nbsp;';
    echo '<a class="w3-button w3-green" href="../page/docs_link.php">';
    echo 'Link another person</a>';
    include "../inc/msg.php";
    include "../inc/footer.php";
}
?>
