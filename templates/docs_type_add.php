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
<h1>Add a document type</h1>
<table cellspacing="5" cellpadding="5">
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
<tr>
    <td valign="top">Description</td>
    <td><input size="50" maxlength="50" type="text" name="description"></td>
</tr>
<tr>
    <td valign="top">PoPI?</td>
    <td>
    <select name="popi">
    <option value="0">No</option>;
    <option value="1">Yes</option>;
    </select>
    </td>
</tr>
<tr>
    <td valign="top">Storage path</td>
    <td><input size="50" maxlength="50" type="text" name="path"></td>
</tr>
<tr>
    <td valign="top">Role that can see documents</td>
    <td>
        <select name="role">
            <option value="0">--== Please select ==--</option>
            <?php
            $sql = 'select id, role_name ';
            $sql .= 'from roles ';
            $sql .= 'order by role_name ';
            $rows = query($sql);
            foreach($rows as $row) {
                echo "\n" . '<option value="' . $row["role_name"] . '">' . $row["role_name"] . '</option>';
            } 
            ?>
        </select>
    </td>
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
    echo '<h1>Add a Document Type</h1>';
    $errorList = array();
    $description = test_input($_POST["description"]);
    $popi = test_input($_POST["popi"]);
    if (!($popi == 0 or $popi == 1)) {
        $errorList[] = "PoPI - please select 'Yes' or 'No'.  ";
    }
    //echo "<br>PoPI = $popi";
    //echo "<br>Description = $description";
    $path = test_input($_POST["path"]);
    $role = test_input($_POST["role"]);
    $user_id = $_SESSION["id"];
    include "../inc/db_open.php";
    if (sizeof($errorList) == 0) {
        $sql = "insert into docs_type (description, popi, path, role, ";
        $sql .= "user_id) values ('";
        $sql .= $description . "', " . $popi . ", '" . $path . "', '";
        $sql .= $role . "', ";
        $sql .= $user_id . ")";
        //echo "<br>" . $sql . "</br>";
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
    echo '<a class="w3-button w3-green" href="../page/docs_type_list.php">';
    echo 'Back to Document Types List</a>&nbsp;';
    include "../inc/msg.php";
    include "../inc/footer.php";
}
?>
