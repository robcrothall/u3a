<?php
/**
 * Program membership_add
 * 
 * Maintain the Memberships Table
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
$message = "";
$people_id = $_SESSION["selected_people_id"];
if ($_SERVER["REQUEST_METHOD"] <> "POST") {
    include "../inc/db_open.php";
    ?>
<h1>Add a Group Membership</h1>
<table cellspacing="5" cellpadding="5">
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
<tr>
    <td valign="top"><b>Person</b></td>
    <td>
        <?php
        $full_name = full_name($people_id);
        echo $full_name;
        /*
        $sql = "select surname, first_name, other_name ";
        $sql .= "from people where id = " . $people_id;
        foreach ($handle->query($sql) as $row) {
            echo $row["surname"] . ", " . $row["first_name"] . " ";
            echo $row["other_name"];
        }
        */
        ?>
    </td>
</tr>
<tr>
    <td valign="top"><b>Group Name</b></td>
    <td>
        <select name="group_id">
    <?php
    echo '<option value="0" selected>Please choose</option>' . "\n"; 
    $sql = "SELECT id, group_name, fee_reqd ";
    $sql .= "FROM `groups` ";
    $sql .= 'where status like "open" ';
    $sql .= "and id not in (select distinct group_id from memberships ";
    $sql .= "where people_id = " . $people_id . ") ";
    $sql .= "order by group_name";
    $message .= $sql . ';';
    //echo $sql;
    foreach ($handle->query($sql) as $row) {
        echo '<option value="' . $row["id"] . '">';
        echo $row["group_name"] . "</option>\n";
    }
    ?>
        </select>
    </td>
</tr>
<tr>
    <td>
        <b>Effective date</b>
    </td>
    <td>
        <input type="date" name="effective_date" 
            value="<?php echo date("Y-m-d"); ?>" />
    </td>
</tr>
<tr>
    <td valign="top"><b>Group Leadership?</b></td>
    <td>
    <select name="is_manager">
        <option value="N" selected>No</option>
        <option value="Y">Yes</option>
    </select>
    </td>
</tr>
<tr>
    <td colspan=2>
        <input type="submit" name="submit" value="Add" 
            class="w3-button w3-green"/>&nbsp;
        <a class="w3-button w3-green" 
        href="../page/people_read.php?id=<?php echo $people_id; ?>"
            >Return to person</a>&nbsp;
    </td>
</tr>
</form>
</table>
    <?php
} else {
    include "../inc/msg.php";
    echo '<h1>Add a Group Membership</h1>';
    include "../inc/db_open.php";
    $message = "";
    $people_id = $_SESSION["selected_people_id"];
    $errorList = array();
    if (!is_numeric($people_id)) {
        $errorList[] = "People_id is missing or invalid. ";
    } else {
        if ($people_id == 0) {
            $errorList[] = "Please choose a person. ";
        }
    }
    $group_id = test_input($_POST["group_id"]);
    if (!is_numeric($group_id)) {
        $errorList[] = "Group_id is missing or invalid. ";
        $group_id = 0;
    } else {
        if ($group_id == 0) {
            $errorList[] = "Please choose a group. ";
        }
    }
    $group_name = "Not valid";
    if ($group_id != 0 && is_numeric($group_id)) {
        // Valid group_id
        $sql = "select group_name from `groups` where id = " . $group_id;
        foreach ($handle->query($sql) as $row) {
            $group_name = $row["group_name"];
        }
    }
    $effective_date = test_input($_POST["effective_date"]);
    if ($effective_date == "") {
        $effective_date = date("Y-m-d");
    }
    $join_date = $effective_date;
    $is_manager = test_input($_POST["is_manager"]);
    $user_id = $_SESSION["id"];
    if ($group_id == 0) {
        $errorList[] = "Please choose a group. ";
    }
    $sql = "select count(*) as kount from memberships ";
    $sql .= "where people_id = " . $people_id . " and group_id = " . $group_id;
    $rows = query($sql);
    if (count($rows) > 0 && $rows[0]["kount"] > 0) {
        $errorList[] = "This person is already a member of the group " . $group_name . ".";
    }
    if ($is_manager != "Y" && $is_manager != "N") {
        $errorList[] = "Please choose whether this person is a group leader.";
    }
    if ($group_name == "Deceased") {
        $sql = "select count(*) as kount from memberships ";
        $sql .= "where people_id = " . $people_id . " and group_id != 27 ";
        $rows = query($sql);
        if (count($rows) > 0 && $rows[0]["kount"] > 0) {
            $errorList[] = "Please delete all other memberships for this person before adding them to the Deceased group.";
        }
    }
    if ($group_name == "Ex-Resident") {
        $sql = "select count(*) as kount from memberships ";
        $sql .= "where people_id = " . $people_id . " and group_id != 2 ";
        $rows = query($sql);
        if (count($rows) > 0 && $rows[0]["kount"] > 0) {
            $errorList[] = "Please delete all other invalid memberships for this person before adding them to the Ex-Resident group.";
        }
    }
    //include "../inc/db_open.php";
    if (sizeof($errorList) == 0) {
        //$join_date = date("Y-m-d");
        $sql = "insert into memberships (people_id, group_id, is_manager, ";
        $sql .= "join_date, status, user_id) values (";
        $sql .= $people_id . ", " . $group_id . ", '" . $is_manager . "', '";
        $sql .= $join_date . "', 'Validated', " . $user_id . ")";
        //$message = $sql;
        $result = mysqli_query($handle, $sql) 
            or die("Error in query: $sql. " . mysqli_error($handle));
        $message .= "Update successful.";
        // Add a history record
        $sql = "insert into history (people_id, event_date, notes, user_id  ";
        $sql .= ") values (";
        $sql .= $people_id . ", '" . $join_date . "', '";
        $sql .= "Joined group " . $group_name . "', " . $user_id . ")";
        //$message .= $sql;
        $result = mysqli_query($handle, $sql) 
            or die("Error in query: $sql. " . mysqli_error($handle));
        //echo $sql;
        // mysqli_free_result($result);
    } else {
        echo 'The following errors were encountered:<br>';
        echo '<ul>';
        for ($x=0; $x<sizeof($errorList); $x++) {
            echo "<li>$errorList[$x]<br></li>";
        }
        echo '</ul>';    
    }
    echo '<a class="w3-button w3-green" ';
    echo 'href="../page/people_read.php?id=' . $people_id . '"';
    echo '>Return to person</a>&nbsp;';
    include "../inc/msg.php";
    include "../inc/footer.php";
}
?>
