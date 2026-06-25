<?php
/**
 * Program user_add
 * 
 * Add a user.
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
$successList = array();
static $handle;
require "../inc/head.php";
require "../inc/body.php";
require "../inc/menu.php";
require "../inc/msg.php";
if ($_SERVER["REQUEST_METHOD"] <> "POST") {
    include "../inc/db_open.php";
    if (!empty($_SESSION["selected_username"])) {
        $selected_username = $_SESSION["selected_username"];
    } else {
        $selected_username = "";
    }
    if (!empty($_SESSION["password"])) {
        $password = $_SESSION["password"];
    } else {
        $password = "";
    }
    if (!empty($_SESSION["confirmation"])) {
        $confirmation = $_SESSION["confirmation"];
    } else {
        $confirmation = "";
    }
    if (!empty($_SESSION["selected_people_id"])) {
        $selected_people_id = $_SESSION["selected_people_id"];
    } else {
        $selected_people_id = "";
    }
    if (!empty($_SESSION[""])) {
        $surname = $_SESSION["surname"];
    } else {
        $surname = "";
    }
    if (!empty($_SESSION["first_name"])) {
        $first_name = $_SESSION["first_name"];
    } else {
        $first_name = "";
    }
    if (!empty($_SESSION["phone"])) {
        $phone = $_SESSION["phone"];
    } else {
        $phone = "";
    }
    if (!empty($_SESSION["mobile"])) {
        $mobile = $_SESSION["mobile"];
    } else {
        $mobile = "";
    }
    if (!empty($_SESSION["email"])) {
        $email = $_SESSION["email"];
    } else {
        $email = "";
    }
    if (!empty($_SESSION["selected_member_exp"])) {
        $selected_member_exp = $_SESSION["selected_member_exp"];
    } else {
        $selected_member_exp = "";
    }
    if (!empty($_SESSION["notes"])) {
        $notes = $_SESSION["notes"];
    } else {
        $notes = "";
    }
    ?>
<h1>Add a User</h1>
<h2>Registering a User</h2>
<p>All Residents are registered, by default, so they need not be registered here.  
    Only register staff, contractors, and associates.</p>
<p>Details will be taken from the People records, so please ensure that the record 
    has been updated and checked.</p>
<table cellspacing="5" cellpadding="5">
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
<tr>
    <td valign="top">Name and details:</td>
    <td>
        <select autofocus name="people_id">
    <?php
    echo '<option value="0" selected>Please choose</option>\n';
    $sql = "SELECT id, surname, first_name, other_names, given_name ";
    $sql .= "FROM people a ";
    $sql .= "where a.id not in (select distinct b.people_id from memberships b, groups c ";
    $sql .= "where b.group_id = c.id and c.group_name = 'Residents') ";
    $sql .= "order by surname, first_name";
    $rows = query($sql);
    $selected = "";
    foreach ($rows as $row) {
        if ($selected_people_id == $row["id"]) {
            $selected = " selected ";
        } else {
            $selected = "";
        }
        $name = $row["surname"];
        if (!empty($row["first_name"])) {
            $name .= ", " . $row["first_name"];
        }
        if (!empty($row["other_names"])) {
            $name .= " " . $row["other_names"];
        }
        if (!empty($row["given_name"])) {
            $name .= " (" . $row["given_name"] . ")";
        }
        echo '<option value="' . $row["id"] . '"' . $selected . ">";
        echo $name . "</option>\n";
    }
    ?>
        </select>
    </td>
</tr>
<tr>
    <td valign="top"><label for="selected_username">Username:</label></td>
    <td><input id="selected_username" name="selected_username" type="text" length=50
        required value="<?php echo $selected_username; ?>"/></td>
</tr>
<tr>
    <td valign="top"><label for="password">Password:</label></td>
    <td><input id="password" name="password" type="password" length=50 
        required value="<?php echo $password; ?>"/></td>
</tr>
<tr>
    <td valign="top"><label for="confirmation">Confirm password:</label></td>
    <td><input id="confirmation" name="confirmation" type="password" length=50 
        required value="<?php echo $confirmation; ?>"/></td>
</tr>
<tr>
    <td valign="top"><label for="selected_member_exp">
        Expiry date (Optional):</label></td>
    <td><input id="selected_member_exp" name="selected_member_exp" 
        type="text" length=10 
        placeholder="YYYY-MM-DD" value="<?php echo $selected_member_exp; ?>"/>
    </td>
</tr>
<tr>
    <td valign="top"><label for="roles">Roles:</label></td>
    <td>
    <?php
    $sql = "Select id, role_name from roles order by role_name";
    $roles = query($sql);
    foreach ($roles as $r) {
        echo '<input type="checkbox" id="role' . $r["id"] . '" name="role'
            . $r["id"] . '" value="' . $r["id"] . '"';
        echo '>&emsp;<label for="role' . $r["id"] . '">' . $r["role_name"] 
            . '</label><br>';
    }
    ?>
    </td>
</tr>
<tr>
    <td valign="top"><label for="roles">Department(s):</label></td>
    <td>
    <?php
    $sql = "Select id, dept_name from dept order by dept_name";
    $rows = query($sql);
    foreach ($rows as $r) {
        echo '<input type="checkbox" id="dept' . $r["id"] . '" name="dept'
            . $r["id"] . '" value="' . $r["id"] . '"';
        echo '>&emsp;<label for="dept ' . $r["id"] . '">' . $r["dept_name"] 
            . '</label><br>';
    }
    ?>
    </td>
</tr>
<tr>
    <td valign="top"><label for="notes">Notes (Optional):</label></td>
    <td><textarea id="notes" name="notes" rows="4" 
    cols="50"><?php echo $notes; ?></textarea>
    </td>
</tr>
<tr>
    <td colspan=2>
        <input type="submit" name="submit" value="Add" 
            class="w3-button w3-green"/>&nbsp;
        <a class="w3-button w3-green" href="../page/user_list.php">
            Return to User List</a>&nbsp;
    </td>
</tr>
</form>
</table>
    <?php
} else {
    include "../inc/msg.php";
    echo '<h1>Add a User</h1>';
    $errorList = array();
    $selected_username = test_input($_POST["selected_username"]);
    $selected_people_id = test_input($_POST["people_id"]);
    $password = test_input($_POST["password"]);
    $confirmation = test_input($_POST["confirmation"]);
    $member_expires = test_input($_POST["selected_member_exp"]);
    $notes = test_input($_POST["notes"]);
    $last_logon = "1900-01-01";
    $user_id = $_SESSION["id"];
    if ($selected_people_id == 0) {
        $errorList[] = "Please select the person.  ";
    }
    if (trim($selected_username) == '') {
        $errorList[] = "Please enter a user name. ";
    }
    if (strlen($selected_username) < 3) {
        $errorList[] = "Username is too short (<3). ";
    }
    include "../inc/db_open.php";
    $sql = 'select count(*) as kount from users where username = "';
    $sql .= $selected_username . '"';
    $result = mysqli_query($handle, $sql)
        or die("Error in query: $sql. " . mysqli_error($handle));
    foreach ($handle->query($sql) as $row) {
        if ($row["kount"] > 0) {
            $errorList[] = "A user with that user name is already registered. ";
        }
    }
    if ($password !== $confirmation) {
        $errorList[] = "Password is not the same as confirmation password.  ";
    }
    $number = preg_match('@[0-9]@', $password);
    $upper = preg_match('@[A-Z]@', $password);
    $lower = preg_match('@[a-z]@', $password);
    $specials = preg_match('@[^\w]@', $password);
    if (strlen($password) < 8 || !$number || !$upper || !$lower || !$specials) {
        $errorList[] = "Password must:";
        $errorList[] = "- be at least eight characters";
        $errorList[] = "- contain at least one numeral";
        $errorList[] = "- contain at least one lower case letter";
        $errorList[] = "- contain at least one upper case letter";
        $errorList[] = "- contain at least one special character";
    }
    $selected_member_exp = date("Y-m-d", strtotime("+1 year"));
    $dt = DateTime::createFromFormat("Y-m-d", $member_expires);
    if ($dt !== false && !array_sum($dt::getLastErrors())) {
        $selected_member_exp = $member_expires;
    }
    $_SESSION["selected_username"] = $selected_username;
    $_SESSION["password"] = $password;
    $_SESSION["confirmation"] = $confirmation;
    $_SESSION["selected_people_id"] = $selected_people_id;
    $_SESSION["notes"] = $notes;
    $_SESSION["selected_member_exp"] = $selected_member_exp;
    if (sizeof($errorList) == 0) {
        $mydate = date("Y-m-d");
        $user_id = $_SESSION["id"];
        $sql = "INSERT INTO users (username, hash, people_id, ";
        $sql .= "notes, expiry, last_logon, ";
        $sql .= "user_id) VALUES(?, ?, ?, ?, ?, ?, ?)";
        $rows = query(
            $sql, $selected_username, crypt($password, $selected_username), 
            $selected_people_id, 
            $notes, $selected_member_exp, $mydate, $user_id
        );
        if ($rows === false) {
            apologize("Unable to register your user name - please contact support");
        } else {
            $rows = query("SELECT LAST_INSERT_ID() AS id");
            $new_user_id = $rows[0]["id"];
            $sql = "select surname, first_name, given_name from people where id = ?";
            $rows = query($sql, $selected_people_id);
            $surname = $rows[0]["surname"];
            $first_name = $rows[0]["first_name"];
            $tmp = "User " . $surname . ", " . $first_name;
            $tmp .= " (" . $selected_username;
            $tmp .= ") has been created successfully.<br><br>";
            $successList[] = $tmp;
        }
        // Now we find the roles that were selected
        // Get a list of all possible roles
        $sql = "Select id, role_name from roles order by role_name";
        $roles = query($sql);
        foreach ($roles as $r) {
            if (!empty($_POST["role" . $r["id"]])) {
                $successList[] = $r["role_name"] . " - Role added. ";
                $sql = "insert into user_roles (user_id, role_id, ";
                $sql .= "changed_id) values (?, ?, ?)";
                $result = query(
                    $sql, $new_user_id, $r["id"], $_SESSION["id"]
                );
            }
        }
        // Now we find the departments that were selected
        // Get a list of all possible departments
        $sql = "Select id, dept_name from dept order by dept_name";
        $rows = query($sql);
        foreach ($rows as $r) {
            if (!empty($_POST["dept" . $r["id"]])) {
                $successList[] = $r["dept_name"] . " - Department added. ";
                $sql = "insert into user_dept (user_id, dept_id, ";
                $sql .= "changed_id) values (?, ?, ?)";
                $result = query(
                    $sql, $new_user_id, $r["id"], $_SESSION["id"]
                );
            }
        }
        unset($_SESSION["selected_username"]);
        unset($_SESSION["password"]);
        unset($_SESSION["confirmation"]);
        unset($_SESSION["selected_people_id"]);
        unset($_SESSION["notes"]);
        unset($_SESSION["selected_member_exp"]);
    } else {
        echo 'The following errors were encountered:<br>';
        echo '<ul>';
        for ($x=0; $x<sizeof($errorList); $x++) {
            echo "<li>$errorList[$x]";
        }
        echo '</ul>';    
        echo '<a class="w3-button w3-green" href="../page/user_add.php">';
        echo 'Try again</a>';
    }
    if (sizeof($successList) > 0) {
        echo "<ul>";
        for ($x=0; $x<sizeof($successList); $x++) {
            echo "<li>$successList[$x]";
        }
        echo "</ul>";
    }
    echo '<a class="w3-button w3-green" href="../page/user_list.php">';
    echo 'Back to User List</a>';
    include "../inc/msg.php";
    include "../inc/footer.php";
}
?>
