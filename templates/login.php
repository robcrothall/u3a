<?php
/**
 * Process Logon requests.
 * php version 5
 * 
 * @category SPRV
 * @package  Authentication
 * @author   Rob Crothall <rob@crothall.co.za>
 * @license  <a rel="license" 
 * href="http://creativecommons.org/licenses/by/4.0/">
 * <img alt="Creative Commons License" style="border-width:0" 
 * src="https://i.creativecommons.org/l/by/4.0/88x31.png" /></a>
 * <br />This work is licensed under a <a rel="license" 
 * href="http://creativecommons.org/licenses/by/4.0/">
 * Creative Commons Attribution 4.0 International License</a>. CC0
 * @version  GIT: 
 * @link     ../page/search.php
 */
// configuration
    require "../inc/config.php"; 
    //require "../inc/functions.php";
    $_SESSION["module"] = $_SERVER["PHP_SELF"];
    $_SESSION["id"] = "0";
    $_SESSION["username"] = "Unknown";
    $_SESSION["user_first_name"] = "";
    $_SESSION["user_surname"] = "Unknown";
    $_SESSION["user_full_name"] = "Unknown";
    $_SESSION["member_exp"] = "Unknown";
    $_SESSION["user_role"] = "Visitor";
    $_SESSION["selected_people_id"] = 0;
    $_SESSION["search_name_start"] = "";

    // if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // validate submission
    if (empty($_POST["username"])) {
        apologize("You must provide your username.");
    } else if (empty($_POST["password"])) {
            apologize("You must provide your password.");
    }
    $user_name_given = test_input($_POST["username"]);
    $password_given = test_input($_POST["password"]);
        // query database for user
    $rows = query("SELECT * FROM users WHERE username = ?", $user_name_given);
    //var_dump(__LINE__, $rows);
        // if we found user, check password
    if (count($rows) == 1) {
        // first (and only) row
        $row = $rows[0];
        // compare hash of user's input against hash that's in database
        if (crypt($_POST["password"], $row["hash"]) == $row["hash"]) {
            // remember that user's now logged in by storing user's ID in session
            $_SESSION["id"] = $row["id"];
            $_SESSION["username"] = $row["username"];
            $people_id = $row["people_id"];
            $sql = "select * from people where id = ?";
            $p = query($sql, $people_id);
            $_SESSION["user_first_name"] = $p[0]["first_name"];
            if (strlen($p[0]["given_name"]) > 1) {
                $_SESSION["user_first_name"] = $p[0]["given_name"];
            }
            $_SESSION["user_surname"] = $p[0]["surname"];
            $_SESSION["user_full_name"] = full_name($people_id);
            $_SESSION["member_exp"] = $row["member_exp"];
            //$_SESSION["user_role"] = $row["user_role"];
            // log it
            $success = true;
            login_log($user_name_given, $password_given, $success);
            $today = date("Y-m-d");
            $rows = query(
                "update users set last_logon = ? where id = ?", 
                $today, $_SESSION["id"]
            );
            // redirect to search
            redirect("../page/news_list.php");
        }
    } else {
        // check if they are in people table
        /*$rows = query("SELECT id, account_no, old_account_no, id_no, surname, first_name, 
            home_phone, mobile_phone, home_email  
            FROM people where id_no = ?", $password_given
        );*/
        $sql = "SELECT id, account_no, surname, first_name, given_name ";
        $sql .= "FROM people where account_no = ? ";
        $rows = query($sql, $user_name_given);
        //var_dump(__LINE__, $rows);
        if (count($rows) == 1) {
            $row = $rows[0];
            $people_id = $row["id"];
            $_SESSION["user_full_name"] = full_name($people_id);
            $_SESSION["user_first_name"] = $row["first_name"];
            if (strlen($row["given_name"]) > 1) {
                $_SESSION["user_first_name"] = $row["given_name"];
            }
            $_SESSION["user_surname"] = $row["surname"];
            $query_pw = my_encrypt($password_given);
            //var_dump(__LINE__, $query_pw);
            $pw_sql = "SELECT * FROM sensitive_text WHERE encrypted_text = ? and text_type = 2 ";
            $pw_sql .= "and people_id in (select people_id from memberships where group_id = 5)";
            $pw_rows = query($pw_sql, $query_pw);
            //var_dump(__LINE__, $pw_rows);
            if (count($pw_rows) == 1) {

            //if (strtoupper($row["account_no"]) == strtoupper($user_name_given)) {
                $new_pw = crypt($password_given, $user_name_given);
                $sql = "insert into users (username, hash, surname, first_name, ";
                $sql .= "people_id, member_exp, last_logon, user_id) ";
                $sql .= "values (?,?,?,?,?,?,?,?)";
                $rows = query(
                    $sql, $row["account_no"], $new_pw, 
                    $row["surname"], $row["first_name"], 
                    date("Y-m-d", strtotime("+1 year")), date("Y-m-d"), 1
                );
                if ($rows === false) {
                    apologize("Unable to register your user name - please contact support");
                }
                $rows = query("SELECT LAST_INSERT_ID() AS id");
                $id = $rows[0]["id"];
                $_SESSION["id"] = $id;
                $_SESSION["username"] = $row["account_no"];
                $_SESSION["user_first_name"] = $row["first_name"];
                $_SESSION["user_surname"] = $row["surname"];
                //$_SESSION["user_role"] = "RESIDENT";
                $sql = "select id from roles where role_name = ?";
                $rows = query($sql, "RESIDENT");
                $role_id = $rows[0]["id"];
                $expiry = date("Y-m-d", strtotime("+365 Days"));
                $sql = "insert into user_roles (user_id, role_id, role_expiry, changed_id) ";
                $sql .= "values (?, ?, ?, ?)";
                $rows = query($sql, $id, $role_id, $expiry, $id);
                // log it
                $success = true;
                login_log($user_name_given, $password_given, $success);
                $today = date("Y-m-d");
                //$rows = query("update users set last_logon = ? where id = ?", 
                //    $today, $_SESSION["id"]);
                // redirect to search
                redirect("../page/news_list.php");
            } else {
                $success = false;
                //print_r(strtoupper($row["account_no"]));
                //print_r(strtoupper($user_name_given));
                login_log($user_name_given, $password_given, $success);
            }
        }
    }
    // log it
//    print_r(strtoupper($row["account_no"]));
//    print_r(strtoupper($user_name_given));
    $success = false;
    login_log($user_name_given, $password_given, $success);
    // else apologize
    apologize("Invalid username and/or password.");
} else {
    // else render form
    render("../view/login_form.php", ["title" => "Log In"]);
}
?>
