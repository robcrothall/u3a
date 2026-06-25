<?php
/**
 * Program docs_type_list
 * 
 * List available document types 
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
?>
<h1>Available document types</h1>
<?php
if (check_role("DOCS") or check_role("ADMIN")) {
    echo '<a class="w3-button w3-green" href="../page/docs_type_add.php">Add a Document Type</a>';
}
?>
<table cellspacing="5" cellpadding="5">
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
<tr>
    <th>Description</th>
    <th>Role</th>
    <th>Document Path</th>
    <th>Action</th>
</tr>
    <?php
    $sql = "SELECT id, description, role, path "; 
    $sql .= "FROM docs_type ";
    $sql .= "order by description ";
    //echo "<br>";
    //var_dump($sql);
    //echo "<br>";
    $rows = query($sql);
    foreach ($rows as $row) {
        echo '<tr><td>' . $row["description"] . "</td>";
        echo '<td>' . $row["role"] . "</td>";
        echo '<td>' . $row["path"] . '</td>';
        echo '  <td>';
        if (check_role("DOCS")) {
            echo '<a class="w3-button w3-green" href="../page/docs_type_edit.php?id=';
            echo $row['id'] . '">Update</a>';
        }
        if (check_role("ADMIN")) {
            echo '<a class="w3-button w3-red" href="../page/docs_type_delete.php?id=';
            echo $row['id'] . '">Delete</a>';
        }
        echo '  </td>';
        echo '</tr>' . "\n";
    }
    ?>
</form>
</table>
<?php
include "../inc/msg.php";
include "../inc/footer.php";
?>
