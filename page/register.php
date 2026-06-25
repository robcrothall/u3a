<?php
/**
 * Program: Register
 * 
 * Register a new User.
 * php version 5
 * 
 * @category WebPage
 * @package  Sample
 * @author   "Rob Crothall" <rob@crothall.co.za>
 * @license  GPL 1.0 or later
 * @version  GIT: <git_id>
 * @link     http://www.sprv.co.za
 */
// configuration
require "../inc/config.php";
$_SESSION["module"] = $_SERVER["PHP_SELF"];
require "../inc/head.php";
require "../inc/body.php";
require "../inc/menu.php";
require "../inc/msg.php";
require "../inc/db_open.php";
// if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["username"])) {
        $_SESSION["username"] = test_input($_POST["username"]);
    }
    if (!empty($_POST["password"])) {
        $_SESSION["password"] = test_input($_POST["password"]);
    }
    if (!empty($_POST["confirmation"])) {
        $_SESSION["confirmation"] = test_input($_POST["confirmation"]);
    }
    if (!empty($_POST["title_id"])) {
        $_SESSION["title_id"] = test_input($_POST["title_id"]);
    }
    if (!empty($_POST["surname"])) {
        $_SESSION["surname"] = test_input($_POST["surname"]);
    }
    if (!empty($_POST["first_name"])) {
        $_SESSION["first_name"] = test_input($_POST["first_name"]);
    }
    if (!empty($_POST["given_name"])) {
        $_SESSION["given_name"] = test_input($_POST["given_name"]);
    }
    if (!empty($_POST["address_line_1"])) {
        $_SESSION["address_line_1"] = test_input($_POST["address_line_1"]);
    }
    if (!empty($_POST["address_line_2"])) {
        $_SESSION["address_line_2"] = test_input($_POST["address_line_2"]);
    }
    if (!empty($_POST["address_line_3"])) {
        $_SESSION["address_line_3"] = test_input($_POST["address_line_3"]);
    }
    if (!empty($_POST["city_id"])) {
        $_SESSION["city_id"] = test_input($_POST["city_id"]);
    }
    if (!empty($_POST["postal_code"])) {
        $_SESSION["postal_code"] = test_input($_POST["postal_code"]);
    }
    if (!empty($_POST["phone_no"])) {
        $_SESSION["phone_no"] = test_input($_POST["phone_no"]);
    }
    if (!empty($_POST["mobile_no"])) {
        $_SESSION["mobile_no"] = test_input($_POST["mobile_no"]);
    }
    if (!empty($_POST["email"])) {
        $_SESSION["email"] = test_input($_POST["email"]);
    }
    if (!empty($_POST["speaker"])) {
        $_SESSION["speaker"] = test_input($_POST["speaker"]);
    }
    if (!empty($_POST["field_of_interest"])) {
        $_SESSION["field_of_interest"] = test_input($_POST["field_of_interest"]);
    }
    if (!empty($_POST["skills"])) {
        $_SESSION["skills"] = test_input($_POST["skills"]);
    }
    if (!empty($_POST["subjects"])) {
        $_SESSION["subjects"] = test_input($_POST["subjects"]);
    }
    // validate submission
    if (empty($_POST["username"])) {
        apologize("You must provide your User Name.");
    } elseif (strlen($_POST["username"]) < 5) {
        apologize("Your User Name must be at least 5 characters long.");
    } else {
        $username = test_input(substr($_POST['username'], 0, 50));
        if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
            apologize("Your User Name must contain only letters and numbers.");
        }
    }
    if (empty($_POST["password"])) {
        apologize("You must provide your password.");
    } elseif (strlen($_POST["password"]) < 6) {
        apologize("Your password must be at least 6 characters long.");
    }
    if (empty($_POST["confirmation"])) {
        apologize("You must provide your confirmation password.");
    }
    if ($_POST["password"] !== $_POST["confirmation"]) {
        apologize("Your password and confirmation password are not identical.");
    }
    if (empty($_POST["people_id"])) {
        apologize("You must select a person");
    } elseif ($_POST["people_id"] == 0) {
        apologize("You must select a person");
    }
    // query database for username
    $username = test_input(substr($_POST['username'], 0, 50));
    $rows = query("SELECT * FROM users WHERE username = ?", $username);

    // if we found user, tell him he is already registered
    if (count($rows) > 0) {
        apologize(
            "Your username has already been registered - please choose another, " . 
            "or log on.  If you don't remember your password, contact " . 
            "Administration in Settlers Park."
        );
    }
    // if the person is already registered, refuse to register her/him again
    $rows = query(
        "SELECT * FROM users WHERE people_id = ?", $_POST["people_id"]
    );

    // if we found user, tell him he is already registered
    if (count($rows) > 0) {
        apologize(
            "This person has already been registered by User Name = " . $username .
            " - please log on.  If you don't remember your password, " . 
            "contact Administration in Settlers Park."
        );
    }
    $rows = query("select * from people where id = ?", $_POST["people_id"]);
    // insert the new user into the users table
    $people_id = $rows[0]["id"];
    $username = test_input($_POST['username']);
    $surname = $rows[0]["surname"];
    $first_name = $rows[0]["first_name"];
    if (!empty($rows[0]["work_phone"])) {
        $phone = $rows[0]["work_phone"];
    } elseif (!empty($rows[0]["home_phone"])) {
        $phone = $rows[0]["home_phone"];
    } else {
        $phone = "";
    }
    if (!empty($rows[0]["mobile_phone"])) {
        $mobile = $rows[0]["mobile_phone"];
    } else {
        $mobile = "";
    }
    if (!empty($rows[0]["work_email"])) {
        $email = $rows[0]["work_email"];
    } elseif (!empty($rows[0]["home_email"])) {
        $email = $rows[0]["home_email"];
    } else {
        $email = "";
    }
    $mydate = date("Y-m-d");
    $expdate = date("Y-m-d", strtotime("+1 year"));
    $role = strtoupper($rows[0]["status"]);
    $user_id = $_SESSION["id"];
    $sql = "INSERT INTO users (username, hash, people_id, surname, first_name, ";
    $sql .= "phone, mobile, email, member_exp, last_logon, user_role, user_id) ";
    $sql .= "VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $rows = query(
        $sql, $username, crypt($_POST["password"], $username), $people_id, 
        $surname, $first_name, $phone, $mobile, $email, $expdate, $mydate, 
        $role, $user_id
    );
    if ($rows === false) {
        apologize("Unable to register your user name - please contact support");
    }
    $rows = query("SELECT LAST_INSERT_ID() AS id");
    $id = $rows[0]["id"];
    $rows = query("SELECT id, role_days FROM roles WHERE role_name = ?", $role);
    if (count($rows) == 1) {
        $role_id = $rows[0]["id"];
        $role_days = $rows[0]["role_days"];
        $role_expiry = date("Y-m-d", strtotime("+" . $role_days . " day"));
        //print_r($role_expiry);
        $sql = "insert into user_roles (user_id, role_id, role_expiry, changed_id)";
        $sql .= " values (?, ?, ?, ?)";
        $rows = query($sql, $id, $role_id, $role_expiry, $user_id);
    }
    // redirect to the search page
    redirect("../ctl/search.php");
} //else {
    //render("../page/register_form.php", ["title" => "Register"]);

//} 
?>
<h2>Registering a User</h2>
<div class="w3-container">
<form class="form-control full-width" action="../page/register.php" method="post">
    <fieldset>
        <div class="form-group">
            Username:<br>
            <input autofocus class="form-control full-width" style="width: 100%"
             name="username" type="text"/>
        </div>
        <div class="form-group">
                Password:<br>
            <input class="form-control full-width" style="width: 100%"
             name="password" type="password"/>
        </div>
        <div class="form-group">
                Re-enter password:<br>
            <input class="form-control" style="width: 100%" name="confirmation"
             type="password"/>
        </div>
        <div class="form-group">
                Title:<br>
                <select name="title_id">
                    <option value="0" selected>Please choose</option>
                    <?php
                    $sql = "SELECT id, title FROM `title` order by title";
                    $rows = query($sql);
                    foreach ($rows as $row) {
                        echo '<option value="' . $row["id"] . '"' . ">" . $row["title"] . "</option>\n";
                    }
                    ?>
                </select>
        </div>
        <div class="form-group">
                Surname:<br>
            <input class="form-control" style="width: 100%" name="surname" type="text"/>
        </div>
        <div class="form-group">
                First name:<br>
            <input class="form-control" style="width: 100%" name="first_name" type="text"/>
        </div>
        <div class="form-group">
                Given name:<br>
            <input class="form-control" style="width: 100%" name="given_name" type="text"/>
        </div>
        <div class="form-group">
                Address line 1:<br>
            <input class="form-control" style="width: 100%" name="address_line_1" type="text"/>
        </div>
        <div class="form-group">
                Address line 2:<br>
            <input class="form-control" style="width: 100%" name="address_line_2" type="text"/>
        </div>
        <div class="form-group">
                Address line 3:<br>
            <input class="form-control" style="width: 100%" name="address_line_3" type="text"/>
        </div>
        <div class="form-group">
                City:<br>
                <select name="city_id">     
                    <option value="0" selected>Please choose</option>
                    <?php
                    $sql = "SELECT id, city_name FROM `cities` order by preferred desc, city_name";
                    $rows = query($sql);
                    foreach ($rows as $row) {
                        echo '<option value="' . $row["id"] . '"' . ">" . $row["city_name"] . "</option>\n";
                    }
                    ?>
                </select>
            </div>
        <div class="form-group">
                Postal code:<br>
            <input class="form-control" style="width: 100%" name="postal_code" type="text"/>
        </div>
        <div class="form-group">
                Phone number:<br>
            <input class="form-control" style="width: 100%" name="phone_no" type="text"/>
        </div>
        <div class="form-group">
                Mobile number:<br>
            <input class="form-control" style="width: 100%" name="mobile_no" type="text"/>
        </div>
        <div class="form-group">
                Email address:<br>
            <input class="form-control" style="width: 100%" name="email" type="text"/>
        </div>
        <div class="form-group">
                Would you like to be a speaker?:<br>
                <select name="speaker">
                    <option value="0" selected>Please choose</option>
                    <option value="1">Yes</option>
                    <option value="2">No</option>
                </select>
            </div>
        <div class="form-group">
                Field of interest, or possible topics for your presentation:<br>
            <input class="form-control" style="width: 100%" name="field_of_interest" type="text"/>
        </div>
        <div class="form-group">
                What are your skills or expertise:<br>
            <input class="form-control" style="width: 100%" name="skills" type="text"/>
        </div>
        <div class="form-group">
                What subjects would you like to see offered by the club?:<br>
            <input class="form-control" style="width: 100%" name="subjects" type="text"/>
        </div>
            <br>
        <div class="form-group">
            <button type="submit" class="w3-button w3-green">Register</button> or 
            choose another menu option
        </div>
    </fieldset>
</form>
<p>If any information found on the site is thought to be inaccurate or 
    inappropriate, please send details to 
    <a href="mailto:rob@crothall.co.za?Subject=U3A%20Website" target="_top">
        Rob Crothall</a>.
</p>
</div>
