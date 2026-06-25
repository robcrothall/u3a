<?php
/**
 * Program: people_edit
 * 
 * Edit a people record.
 * 
 * php version 5
 * 
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category WebPage
 * @package  SPRV_v2
 * @author   "Rob Crothall" <rob@crothall.co.za>
 * @copyright  1997-2005 The PHP Group
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
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
    $people_id = $_SESSION["rec_id"];
    $_SESSION["people_id"] = $people_id;
    $data = query("select * from people where id = ?", $people_id); 
    $_SESSION["search_name_start"] = $data[0]["surname"];
    $surname         = $data[0]["surname"];
    $first_name      = $data[0]["first_name"];
    $other_name     = $data[0]["other_name"];
    $given_name      = $data[0]["given_name"];
    if ($surname    == strtoupper($surname) or $surname == strtolower($surname)) {
        $surname    = ucwords(strtolower($surname));
    }
    if ($first_name == strtoupper($first_name)
        or $first_name == strtolower($first_name)
    ) {
        $first_name = ucwords(strtolower($first_name));
    }
    if ($other_name == strtoupper($other_name) 
        or $other_name == strtolower($other_name)
    ) {
        $other_name = ucwords(strtolower($other_name));
    }
    if ($given_name == strtoupper($given_name) 
        or $given_name == strtolower($given_name)
    ) {
        $given_name = ucwords(strtolower($given_name));
    }
    $title           = ucwords(strtolower($data[0]["title"]));
    $account_no      = strtoupper($data[0]["account_no"]);
    $checked         = $data[0]["checked"];
    $user_id         = $data[0]["user_id"];
    $changed         = $data[0]["changed"];
    $data = query("select username from users where id = ?", $user_id);
    $username        = $data[0]["username"];
    ?>
    <br>
    <h2>Update Person details</h2>
    
    <form action="../page/people_update.php" method="post">
    <input type='submit' value='Save' class='w3-button w3-green' />
    <a href='people.php' class='w3-button w3-green'>Back to people</a>
        <table class='w3-table-all'>
            <tr>
                <td>Surname</td> 
                <input type="hidden" id="rec_id" name="rec_id" 
                    value="<?php echo $people_id; ?>" /></td>
                <td><input type='text' name='surname' class='form-control' 
                    required value="<?php echo $surname; ?>" /></td>
            </tr>
            <tr>
            <td>First name</td>
                <td><input type='text' name="first_name" class='form-control' 
                    required value="<?php echo $first_name; ?>" /></td>
            </tr> 
            <tr>
            <td>Other names</td>
                <td><input type='text' name='other_name' class='form-control' 
                    value="<?php echo $other_name; ?>" /></td>
            </tr> 
            <tr>
            <td>Given name</td>
                <td><input type='text' name='given_name' class='form-control' 
                    value="<?php echo $given_name; ?>" /></td>
            </tr> 
            <tr>
            <td>Title - needs to be a dropdown</td>
                <td><input type='text' name='title' class='form-control' 
                    value="<?php echo $title; ?>" /></td>
            </tr> 
            <tr>
            <td>Account No</td>
                <td><?php echo $account_no; ?></td>
            </tr> 
       <tr>
            <td>Checked</td>
                <td>
      <select name="checked">
    <?php
    $checked_status = ["N","Y","Query"];
    foreach ($checked_status as $status) {
        if ($checked == $status) {
            $selected = " selected";
        } else {
            $selected = "";
        }
        echo "<option value=$status $selected>$status</option>\n";
    }
    ?>
      </select>
                </td>
            </tr> 
            <tr>
                <td></td>
                <td>
                    <input type='submit' value='Save' class='w3-button w3-green' />
                    <a href='people.php' class='w3-button w3-green'>Back to people</a>
                </td>
            </tr>
        </table>
    </form>
<?php
} else {
    include "../inc/msg.php";
    echo '<h1>Edit a Department</h1>';
    $errorList = array();
    $id = test_input($_POST["id"]);
    $dept_name = test_input($_POST["dept_name"]);
    $old_dept = $_SESSION["old_dept"];
    $user_id = $_SESSION["id"];
    if (trim($dept_name) == '') {
        $errorList[] = "Please enter a department name.";
    }
    $hod = 0;
    if (isset($_POST["hod"])) {
        if (is_numeric($_POST["hod"])) {
            $hod = test_input($_POST["hod"]);
        }
    }
    if ($hod == 0) {
        $errorList[] = "Please select a manager.";
    } 
    $task_email = "";
    if (isset($_POST["task_email"])) {
        $task_email = test_input($_POST["task_email"]);
    }
    if (strlen($task_email) > 0) {
        if (!filter_var($task_email, FILTER_VALIDATE_EMAIL)) {
            $errorList[] = "Invalid email format.";
        }
    }
    include "../inc/db_open.php";
    $sql = 'select count(*) as kount from dept where dept_name = "';
    $sql .= $dept_name . '" and id <> ' . $id;
    $rows = query($sql);
    foreach ($rows as $row) {
        if ($row["kount"] > 0) {
            $errorList[] = "A department with that name is already registered.";
        }
    }
    if (sizeof($errorList) == 0) {
        $sql = "update dept set dept_name='" . $dept_name . "'";
        $sql .= ", hod = " . $hod;
        $sql .= ", task_email = '" . $task_email . "'";
        $sql .= ", user_id = '" . $user_id . "'";
        $sql .= " where id = $id";
        $rows = query($sql); 
        if ($dept_name <> $old_dept) {
            $descr = "Department: " . $dept_name;
            $sql = "update `groups` set group_name = ?, description = ? ";
            $sql .= "where group_name = ?";
            //var_dump($sql, $dept_name, $descr, $old_dept);
            $rows = query($sql, $dept_name, $descr, $old_dept);
        }
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
    echo '<a href="../page/dept_list.php" class="w3-button w3-green">';
    echo 'Back to department list</a>';
    include "../inc/msg.php";
    include "../inc/footer.php";
}
?>
