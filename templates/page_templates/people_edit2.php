<?php
/**
 * Program: people_edit
 * 
 * Edit a data row.
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
if ($_SERVER["REQUEST_METHOD"] <> "POST") {
    // we need to display the form, populated from the database
    include "../inc/db_open.php";
    $errorList = array();
    $id = test_input($_GET["id"]);
    //echo "<br>ID = $id";
    if (trim($id) == '') {
        die("No ID specified - please inform SysAdmin.");
    }
    $_SESSION["people_id"] = $id;
    $_SESSION["selected_people_id"] = $id;
    $sql = "select * ";
    $sql .= "from people where id = " . $id;
    $result = mysqli_query($handle, $sql)
        or die("Error in query: $sql. " . mysqli_error($handle));
    $row = $result->fetch_array();
    if (count($row) == 0) {
        die("No result returned from database - please advise SysAdmin.");
    }
    //var_dump(($row));
    // move all row fields into variables
    //$id = $row["id"];
    $surname = $row["surname"];
    $_SESSION["search_name_start"] = $surname;
    //If surname is all upper or lower case, adjust it
    if ($surname == strtoupper($surname) or $surname == strtolower($surname)) {
        $surname = ucwords(strtolower($surname));
        $errorList[] = "Case of surname has been adjusted. ";
    }
    $first_name = $row["first_name"];
    if (empty($first_name)) {
        $errorList[] = "Please add the first name. ";
    } else {
        if ($first_name == strtoupper($first_name)
           or $first_name == strtolower($first_name)
        ) {
            $first_name = ucwords(strtolower($first_name));
            $errorList[] = "Case of first name has beed adjusted. ";
        }
    }
    $other_names = $row["other_names"];
    if (empty($other_names)) {
        $errorList[] = "Please add any other names. ";
    } else {
        if ($other_names == strtoupper($other_names)
           or $other_names == strtolower($other_names)
        ) {
            $other_names = ucwords(strtolower($other_names));
            $errorList[] = "Case of other names has beed adjusted. ";
        }
    }
    $given_name = $row["given_name"];
    if (empty($given_name)) {
        $errorList[] = "Given name is empty. First name will be used. ";
    } else {
        if ($given_name == strtoupper($given_name)
           or $given_name == strtolower($given_name)
        ) {
            $given_name = ucwords(strtolower($given_name));
            $errorList[] = "Case of given name has beed adjusted. ";
        }
    }
    $title_id = $row["title_id"];
    if ($title_id == 0) {
        $errorList[] = "Please select a correct title. ";
    }
    $account_no = $row["account_no"];
    $sex = $row["sex"];
    if (empty($sex)) {
        $errorList[] = "Please enter the sex. ";
    }
    $race_id = $row["race_id"];
    If ($race_id == 6) {
        $errorList[] = "Please specify race. ";
    }
    $checked = $row["checked"];
    $user_id = $row["user_id"];
    $changed = $row["changed"];
    require "../inc/msg.php";
    ?>
<h1>Edit People</h1>
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
<input type="hidden" name="id" value="<?php echo $id; ?>">
<input type="submit" name="submit" value="Save" 
        class='w3-button w3-green'/>&nbsp;
<a class="w3-button w3-green" href="../page/people.php">
Return to people list</a>
&nbsp;
<a class="w3-button w3-green" href="../page/people_read.php?id=<?php echo $id; ?>">
Read peron details</a>
&nbsp;
<table cellspacing="5" cellpadding="5">
<tr>
    <td valign="top">Surname</td>
    <td><input size="50" maxlength="50" type="text" name="surname"
        required autofocus value="<?php echo $surname; ?>"></td>
</tr>
<tr>
    <td valign="top">First name</td>
    <td><input size="50" maxlength="50" type="text" name="first_name"
        required value="<?php echo $first_name; ?>"></td>
</tr>
<tr>
    <td valign="top">Other names</td>
    <td><input size="50" maxlength="50" type="text" name="other_names"
        value="<?php echo $other_names; ?>"></td>
</tr>
<tr>
    <td valign="top">Given name</td>
    <td><input size="50" maxlength="50" type="text" name="given_name"
        value="<?php echo $given_name; ?>"></td>
</tr>
<tr>
    <td valign="top">Title</td>
    <td>
        <select name="title_id">
<?php
$sql = "select id, title from title ";
$sql .= 'where title not like "% and %" ';
$sql .= "order by title";
$titles = query($sql);
foreach ($titles as $t) {
    if ($title_id == $t["id"]) {
        $selected = " selected";
    } else {
        $selected = "";
    }
    echo "<option value=" . $t["id"] . $selected . ">";
    echo $t["title"] . "</option>\n";
}
?>
        </select>
    </td>
</tr>
<tr>
    <td valign="top">Account No</td>
    <td><?php echo $account_no; ?></td>
</tr>
<tr>
    <td>Sex</td>
    <td>
        <select name="sex">
<?php
$sex_choice = ["F","M","?"];
foreach ($sex_choice as $s) {
    if ($sex == $s) {
        $selected = " selected";
    } else {
        $selected = "";
    }
    echo "<option value=$s $selected>$s</option>\n";
}
?>
        </select>
    </td>
</tr> 
<tr>
    <td valign="top">Race</td>
    <td>
        <select name="race_id">
<?php
$sql = "select id, race_name from race ";
$sql .= "order by race_name";
$race_recs = query($sql);
foreach ($race_recs as $t) {
    if ($race_id == $t["id"]) {
        $selected = " selected";
    } else {
        $selected = "";
    }
    echo "<option value=" . $t["id"] . $selected . ">";
    echo $t["race_name"] . "</option>\n";
}
?>
        </select>
    </td>
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
    <td colspan=2><input type="submit" name="submit" value="Save" 
        class='w3-button w3-green'/>&nbsp;
        <a class="w3-button w3-green" href="../page/people.php">
            Return to people list</a>
        &nbsp;
        <a class="w3-button w3-green" 
        href="../page/people_read.php?id=<?php echo $id; ?>">Read peron details</a>
        &nbsp;
    </td>
</tr>
</table>
</form>
<?php
if (sizeof($errorList) > 0) {
    $message = 'The following warnings were encountered:<br>';
    $message .= '<ul>';
    for ($x=0; $x<sizeof($errorList); $x++) {
        $message .= "<li>$errorList[$x]";
    }
    $message .= '</ul>';    
}

include "../inc/msg.php";
include "../inc/footer.php";
} else {
    include "../inc/db_open.php";
    include "../inc/msg.php";
    // We need to validate and update data
    echo '<h1>Edit a People record</h1>';
    $errorList = array();
    $error = false;
    $id = test_input($_POST["id"]);
    if (trim($id) == '') {
        die("No ID specified - please inform SysAdmin.");
    }
    $_SESSION["people_id"] = $id;
    $_SESSION["selected_people_id"] = $id;
    $sql = "select * ";
    $sql .= "from people where id = " . $id;
    $result = mysqli_query($handle, $sql)
        or die("Error in query: $sql. " . mysqli_error($handle));
    $row = $result->fetch_array();
    if (count($row) == 0) {
        die("No result returned from database - please advise SysAdmin.");
    }
    //var_dump(($row));
    // move all row fields into variables
    //$id = $row["id"];
    if (!empty($_POST["surname"])) {
        $surname = test_input($_POST["surname"]);
    } else {
        $surname = $row["surname"];
    }
    $_SESSION["search_name_start"] = $surname;
    //If surname is all upper or lower case, adjust it
    if ($surname == strtoupper($surname) or $surname == strtolower($surname)) {
        $surname = ucwords(strtolower($surname));
        $errorList[] = "Case of surname has been adjusted. ";
    }
    if (!empty($_POST["first_name"])) {
        $first_name = test_input($_POST["first_name"]);
    } else {
        $first_name = $row["first_name"];
    }
    if (empty($first_name)) {
        $errorList[] = "Please add the first name. ";
        $error = true;
    } else {
        if ($first_name == strtoupper($first_name)
           or $first_name == strtolower($first_name)
        ) {
            $first_name = ucwords(strtolower($first_name));
            $errorList[] = "Case of first name has beed adjusted. ";
        }
    }
    if (!empty($_POST["other_names"])) {
        $other_names = test_input($_POST["other_names"]);
    } else {
        $other_names = $row["other_names"];
    }
    if (empty($other_names)) {
        $errorList[] = "Please add any other names. ";
    } else {
        if ($other_names == strtoupper($other_names)
           or $other_names == strtolower($other_names)
        ) {
            $other_names = ucwords(strtolower($other_names));
            $errorList[] = "Case of other names has beed adjusted. ";
        }
    }
    if (!empty($_POST["given_name"])) {
        $given_name = test_input($_POST["given_name"]);
    } else {
        $given_name = $row["given_name"];
    }
    if (empty($given_name)) {
        $errorList[] = "Given name is empty. First name will be used. ";
    } else {
        if ($given_name == strtoupper($given_name)
           or $given_name == strtolower($given_name)
        ) {
            $given_name = ucwords(strtolower($given_name));
            $errorList[] = "Case of given name has beed adjusted. ";
        }
    }
    if (!empty($_POST["title_id"])) {
        $title_id = test_input($_POST["title_id"]);
    } else {
        $title_id = $row["title_id"];
    }
    if ($title_id == 0) {
        $errorList[] = "Please select a correct title. ";
        $error = true;
    }
    $account_no = $row["account_no"];
    if (!empty($_POST["sex"])) {
        $sex = test_input($_POST["sex"]);
    } else {
        $sex = $row["sex"];
    }
    if (empty($sex)) {
        $errorList[] = "Please enter the sex. ";
        $error = true;
    }
    if (!empty($_POST["race_id"])) {
        $race_id = test_input($_POST["race_id"]);
    } else {
        $race_id = $row["race_id"];
    }
    If ($race_id == 6) {
        $errorList[] = "Please specify race. ";
    }
    if (!empty($_POST["checked"])) {
        $checked = test_input($_POST["checked"]);
    } else {
        $checked = $row["checked"];
    }
    $user_id = $_SESSION["id"];
    require "../inc/msg.php";
    if ($error == false) {
        $sql = "update people ";
        $sql .= "set surname='" . $surname . "'";
        $sql .= ", first_name ='" . $first_name . "'";
        $sql .= ", other_names ='" . $other_names . "'";
        $sql .= ", given_name ='" . $given_name . "'";
        $sql .= ", title_id =" . $title_id;
        $sql .= ", sex ='" . $sex . "'";
        $sql .= ", race_id =" . $race_id;
        $sql .= ", checked ='" . $checked . "'";
        $sql .= ", user_id='" . $user_id . "'";
        $sql .= " where id = $id";
        $result = mysqli_query($handle, $sql) 
            or die("Error in query: $sql. " . mysqli_error($handle));
        echo "Update successful.<br><br>";
        // mysqli_free_result($result);
    } else {
        echo 'The update was NOT successful.<br>';
        echo 'The following issues were encountered:<br>';
        echo '<ul>';
        for ($x=0; $x<sizeof($errorList); $x++) {
            echo "<li>$errorList[$x]";
        }
        echo '</ul>';    
    }
    echo '<a class="w3-button w3-green" href="../page/people.php">';
    echo 'Return to people list</a>&nbsp';
    echo '<a href="' . $_SERVER["PHP_SELF"] . '?id=' . $id . '" class="w3-button w3-green">';
    echo 'Try again</a>';
    include "../inc/msg.php";
    include "../inc/footer.php";
}
?>
