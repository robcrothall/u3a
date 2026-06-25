<?php
/**
 * Program: docs_read
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
    $sql .= "doc_path, doc_file, submitted, approved, review, b.description ";
    $sql .= "from docs a, docs_type b ";
    $sql .= "where  a.id = ? ";
    $sql .= "and a.doc_type_id = b.id ";
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
    $doc_path = $rows[0]["doc_path"];
    $doc_file = $rows[0]["doc_file"];
    $submitted = $rows[0]["submitted"];
    $approved = $rows[0]["approved"];
    $review = $rows[0]["review"];
    $description = $rows[0]["description"];
    //echo "<br>";
    //var_dump($doc_id, $doc_name, $doc_group, $doc_subgroup);
?>
<h1>Read document</h1>
<table cellspacing="5" cellpadding="5">
<tr>
    <td valign="top">Document group</td>
    <td><?php echo $doc_group; ?></td>
</tr>
<tr>
    <td valign="top">Document Subgroup</td>
    <td><?php echo $doc_subgroup; ?></td>
</tr>
<tr>
    <td valign="top">Document type</td>
    <td><?php echo $description; ?></td>
</tr>
<tr>
    <td valign="top">Displayed name</td>
    <td>
        <?php 
        echo '<a href="' . $doc_path . $doc_file . '" target="_blank">' . $doc_name . '</a>';
        ?>
    </td>
</tr>
<tr>
    <td valign="top">Version</td>
    <td><?php echo $doc_version; ?></td>
</tr>
<tr>
    <td valign="top">Date submitted</td>
    <td><?php echo $submitted; ?></td>
</tr>
<tr>
    <td valign="top">Date approved</td>
    <td><?php echo $approved; ?></td>
</tr>
<tr>
    <td valign="top">Date to be reviewed</td>
    <td><?php echo $review; ?></td>
</tr>
<tr>
    <td valign="top">Document path</td>
    <td><?php echo $doc_path; ?></td>
</tr>
<tr>
    <td valign="top">Document file</td>
    <td><?php echo $doc_file; ?></td>
</tr>
</table>
<?php
    echo '<a href="../page/docs_list.php" class="w3-button w3-green">';
    echo 'Back to documents list</a>' . "&nbsp;";
    $_SESSION["selected_doc"] = $doc_id;
    echo '<a class="w3-button w3-green" href="../page/docs_link.php">';
    echo 'Link Document to People</a>' . "&nbsp;";
    include "../inc/msg.php";
    include "../inc/footer.php";
}
?>
