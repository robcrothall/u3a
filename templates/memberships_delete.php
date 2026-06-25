<?php
/**
 * Program: asset_delete
 * 
 * Delete an asset.
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
$message = "";
echo '<h1>Delete a Membership</h1>';
if ((!isset($_GET['id'])) || (trim($_GET['id'] == ''))) {
    $message = 'Missing record ID - please inform SysAdmin.';
} else {
    $req_id = test_input($_GET['id']);
    include "../inc/db_open.php";
    $sql = "select * from memberships where id = " . $req_id;
    $result = mysqli_query($handle, $sql);
    if ($result <> false) {
        $row = mysqli_fetch_assoc($result);
        $people_id = $row["people_id"];
        $group_id = $row["group_id"];
        $sql = "select group_name from `groups` where id = " . $group_id;
        $result = mysqli_query($handle, $sql);
        if ($result <> false) {
            $row = mysqli_fetch_assoc($result);
            $group_name = $row["group_name"];
        } else {
            $group_name = "Unknown";
        }
        $sql = "insert into history (people_id, event_date, notes, user_id) ";
        $sql .= "values (" . $people_id . ", '" . date("Y-m-d") . "', ";
        $sql .= "'Membership in " . $group_name . " deleted', " . $_SESSION["id"] . ")";
        $result = mysqli_query($handle, $sql);
        if ($result <> false) {
            $message .= "  History updated.";
        } else {
            $message .= "  Unable to update history - ";
            $message .= "please inform SysAdmin.";
        }
    } else {
        $message .= "  Unable to retrieve membership details - ";
        $message .= "please inform SysAdmin.";
    }
    $sql = "delete from memberships where id = " . $req_id;
    $result = mysqli_query($handle, $sql);
    if ($result <> false) {
        $message .= "  Membership deleted.";
    } else {
        $message .= "  Unable to delete membership - ";
        $message .= "please inform SysAdmin.";
    }
}
echo '<br><br><a class="w3-button w3-green" ';
echo 'href="../page/people_read.php?id=' . $_SESSION["selected_people_id"];
echo '">Back to person</a>';
require "../inc/msg.php";
require "../inc/footer.php";
?>
