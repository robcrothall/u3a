<?php
/**
 * Process Logon requests.
 * php version 5
 * 
 * @category 
 * @package  Authentication
 * @author   Rob Crothall <rob@crothall.co.za>
 * @license  <a rel="license" 
 * href="http://creativecommons.org/licenses/by/4.0/">
 * <img alt="Creative Commons License" style="border-width:0" 
 * src="https://i.creativecommons.org/l/by/4.0/88x31.png" /></a>
 * <br />This work is licensed under a <a rel="license" 
 * href="http://creativecommons.org/licenses/by/4.0/">
 * Creative Commons Attribution 4.0 International License</a>. CC0
 * @version  GIT: <git-id>
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
        apologize("You must provide your email address.");
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
        if (crypt($_POST["password"], $row["hash"]) == $row["hash"] or $row["hash"] == "" or $row["hash"] == null) {
            // remember that user's now logged in by storing user's ID in session
            $_SESSION["id"] = $row["id"];
            $_SESSION["username"] = $row["username"];
            $people_id = $row["people_id"];
            $sql = "select * from people where id = ?";
            $p = query($sql, $people_id);
            $_SESSION["user_first_name"] = $p[0]["first_name"];
        
            if (isset($p[0]["given_name"]) && strlen($p[0]["given_name"]) > 1) {
                $_SESSION["user_first_name"] = $p[0]["given_name"];
            }
            $_SESSION["user_surname"] = $p[0]["surname"];
            $_SESSION["user_full_name"] = full_name($people_id);
            /* $_SESSION["member_exp"] = $row["member_exp"]; Check the paid status */
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
        } else {
            $success = false;
            login_log($user_name_given, $password_given, $success);
            apologize("Invalid username and/or password.");
        }
    } else {
        $success = false;
        login_log($user_name_given, $password_given, $success);
        apologize("Invalid username and/or password.");
    }
} else {
    require "../inc/header.php";
?>
<form action="login.php" method="post" width="100%">
    <fieldset>
        <div class="form-group">
            <input autofocus class="form-control" name="username" 
            placeholder="Email address" type="text"/>
        </div>
        <div class="form-group">
            <input class="form-control" name="password" placeholder="Password" 
            type="password"/>
        </div>
        <div class="form-group">
            <button type="submit" class="w3-button w3-green">Log in</button>
        </div>
    </fieldset>
</form>
<h2>Forgot your password?</h2>
<p>If you have forgotten your password, please send an email to
    <a href="mailto:webmaster@u3aportalfred.org.za?Subject=U3A%20Website" target="_top">
        the Webmaster of U3A Port Alfred</a> and request that your password be reset.
</p>
<h2>Registering as a member of U3A Port Alfred</h2>
<p>If you have not yet registered as a member of U3A Port Alfred, please send an email to
    <a href="mailto:secretary@u3aportalfred.org.za?Subject=U3A%20Website - Membership" target="_top">
        the Secretary of U3A Port Alfred</a> and attach your completed registration form. Alternatively, you can register as a member by completing the form on the
    <a href="../page/register.php">Registration</a> page.
</p>
<p>People who register on this site are added to the mailing list and will receive notice of meetings and the newsletter.  
    Once you pay your membership fee, you will be able to access the recorded presentations and attend meetings at the reduced meeting fee.</p>
<h2>Purpose of this site</h2>
<p>To register members of U3A Port Alfred and to provide access to recorded presentations to paid-up members.</p>
<p>
If any information found on the site is thought to be inaccurate or inappropriate, 
please send details to
 <a href="mailto:webmaster@u3aportalfred.org.za?Subject=U3A%20Website" 
   target="_top">the Webmaster of U3A Port Alfred</a> .
</p>
<?php
}
?>
