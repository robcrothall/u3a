<?php
/**
 * Program: search
 * 
 * Build a search string and execute it.
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
require_once "../inc/config.php"; 

// if form was submitted
//print_r($_SERVER["REQUEST_METHOD"]);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cmd_select = "SELECT distinct a.id, a.surname, a.first_name";
    $cmd_select .= ", a.other_name, a.given_name ";
    $cmd_select .= "";
    $cmd_tables = " from people a";
    $cmd_where = " where ";
    $cmd_and = "";
    /*if (check_role("RESIDENT")) {
        $cmd_where .= " and a.company_id < 3 and a.company_id > 0 ";
    }*/
    $cmd_order_by = " order by surname, first_name";
    if (check_role("STAFF") | check_role("ADMIN")) {
        $cmd_limit = " limit 250";
    } else {
        $cmd_limit = " limit 50";
    }
    $search_string = " ";
    $message = "Selection: ";
    // build up the search string
    //var_dump($_POST);
    // Clear all search parameters
    unset($_SESSION["search_surname"]);
    unset($_SESSION["search_first_name"]);
    unset($_SESSION["search_asset_name"]);
    unset($_SESSION["search_account_no"]);
    unset($_SESSION["search_email"]);
    unset($_SESSION["search_phone"]);
    unset($_SESSION["search_title"]);
    unset($_SESSION["search_group_name"]);
    unset($_SESSION["search_occupation"]);
    unset($_SESSION["search_co_name"]);
    unset($_SESSION["search_sex"]);
    unset($_SESSION["search_race_name"]);
    unset($_SESSION["search_checked_status"]);
    unset($_SESSION["search_date_from"]);
    unset($_SESSION["search_date_to"]);
    unset($_SESSION["search_keyword_or"]);
    unset($_SESSION["search_keyword_and"]);
    if (!empty($_POST["surname"])) {
        $search_string .= $cmd_and . "a.surname like '" . test_input($_POST['surname']) . "' ";
        $cmd_and = " and ";
        $message .= "Surname '" . test_input($_POST['surname']) . "'; ";
        $_SESSION["search_surname"] = test_input($_POST["surname"]);
    }
    if (!empty($_POST["first_name"])) {
        $search_string .= $cmd_and . " (first_name like '" . test_input($_POST["first_name"]) . "' ";
        $cmd_and = " and ";
        $message .= "First name '" . test_input($_POST["first_name"]) . "'; ";
        $_SESSION["search_first_name"] = test_input($_POST["first_name"]);
    }
    if (!empty($_POST["first_name"])) {
        $search_string .= "or other_name like '" . test_input($_POST["first_name"]) . "' ";
        $message .= "Other names '" . test_input($_POST["first_name"]) . "'; ";
    }
    if (!empty($_POST["first_name"])) {
        $search_string .= "or given_name like '" . test_input($_POST["first_name"]) . "') ";
        $message .= "Given name '" . test_input($_POST["first_name"]) . "'; ";
    }
    if (!empty($_POST["account_no"])) {
        $search_string .= $cmd_and . " account_no like '" . test_input($_POST["account_no"]) . "%' ";
        $cmd_and = " and ";
        $message .= "Account No '" . test_input($_POST["account_no"]) . "'; ";
        $_SESSION["search_account_no"] = test_input($_POST["account_no"]);
    }
    // Email is in "Sensitive_text" - so read all email addresses, decrypt them,
    // and insert into a temporary table.
    //$message .= "Clearing temporary table;";
    $sql = "delete from email_addresses ";
    $sql .= "where user_id = " .  $_SESSION["id"] . " and text_type in ('email', 'phone')";
    $result = query($sql);
    //$message .= "Cleared temp table;";

    if (!empty($_POST["email"])) {
        $_SESSION["search_email"] = test_input($_POST["email"]);
        $email = test_input($_POST["email"]);
        $sql2 = "select id, people_id, encrypted_text ";
        $sql2 .= "from sensitive_text ";
        $sql2 .= "where text_type in (";
        $sql2 .=   "select id from sensitive_text_type ";
        $sql2 .=   'where text_description like "%email%")';
        $emails = query($sql2);
        //$message .= "Extracted encrypted text;";
        foreach($emails as $e) {
            $clear_text = my_decrypt($e["encrypted_text"]);
            $sql2 = "insert into email_addresses (user_id, id, people_id, text_type, clear_text) values ";
            $sql2 .= "(" . $_SESSION["id"] . ", " . $e["id"] . ", " . $e["people_id"] . ", ";
            $sql2 .= "'email', '" . $clear_text . "')";
            //$message .= $sql2;
            $result = query($sql2);
            //$message .= "Inserted clear text;";
            //var_dump("<br>Clear text:", $clear_text, "  Result:", $result, "<br>");
        }

        $search_string .= $cmd_and . " a.id in (select b.people_id from email_addresses b ";
        $search_string .= "where user_id = " . $_SESSION["id"] . " and text_type = 'email' ";
        $search_string .= 'and clear_text like "' . $email . '")';
        //$search_string .= "or home_email like '" . $email . "%') ";
        $cmd_and = " and ";
        $message .= "Email address '" . $email . "%'; ";
    }
    if (!empty($_POST["phone"])) {
        $_SESSION["search_phone"] = test_input($_POST["phone"]);
        $phone = test_input($_POST["phone"]);
        $sql2 = "select id, people_id, encrypted_text ";
        $sql2 .= "from sensitive_text ";
        $sql2 .= "where text_type in (";
        $sql2 .=   "select id from sensitive_text_type ";
        $sql2 .=   'where data_type = "phone")';
        //$message .= '<br>' . $sql2;
        $phone_nos = query($sql2);
        //$message .= "Extracted encrypted text;";
        foreach($phone_nos as $e) {
            $clear_text = my_decrypt($e["encrypted_text"]);
            $sql2 = "insert into email_addresses (user_id, id, people_id, text_type, clear_text) values ";
            $sql2 .= "(" . $_SESSION["id"] . ", " . $e["id"] . ", " . $e["people_id"] . ", ";
            $sql2 .= "'phone', '" . $clear_text . "')";
            //$message .= '<br>' . $sql2;
            $result = query($sql2);
            //$message .= "Inserted clear text;";
            //var_dump("<br>Clear text:", $clear_text, "  Result:", $result, "<br>");
        }

        $search_string .= $cmd_and . " a.id in (select b.people_id from email_addresses b ";
        //$search_string .= "where user_id = " . $_SESSION["id"] . " and text_type = 'phone' ";
        $search_string .= "where user_id = " . $_SESSION["id"] . " and text_type = 'phone' ";
        $search_string .= 'and clear_text like "%' . $phone . '%")';
        //$search_string .= "or home_email like '" . $email . "%') ";
        $cmd_and = " and ";
        $message .= "Phone '" . $phone . "'; ";
    }
    if (!empty($_POST["title"]) && test_input($_POST["title"]) != "any") {
        $_SESSION["search_title"] = test_input($_POST["title"]);
        $search_string .= $cmd_and .  "title = '" . test_input($_POST["title"]) . "' ";
        $cmd_and = " and ";
        $message .= "Title '" . test_input($_POST["title"]) . "'; ";
    }
    if (!empty($_POST["memberships"]) && test_input($_POST["memberships"]) != "any") {
        $_SESSION["search_memberships"] = test_input($_POST["memberships"]);
        $search_string .= $cmd_and . " a.id in (select m.people_id from memberships m, `groups` g ";
        $search_string .= 'where g.id = ' .  test_input($_POST["memberships"]);
        // date range goes in here
        if (!empty($_POST["date_from"])) {
            $_SESSION["search_date_from"] = test_input($_POST["date_from"]);
            $search_string .= " and m.join_date >= '" . test_input($_POST["date_from"]) . "' ";
            $message .= "Date from '" . test_input($_POST["date_from"]) . "'; ";
        }
        if (!empty($_POST["date_to"])) {
            $_SESSION["search_date_to"] = test_input($_POST["date_to"]);
            $search_string .= " and join_date <= '" . test_input($_POST["date_to"]) . "' ";
            $message .= "Date to '" . test_input($_POST["date_to"]) . "'; ";
        }
        $search_string .= ' and g.id = m.group_id) ';
        $cmd_and = " and ";
        $message .= "Memberships '" . test_input($_POST["memberships"]) . "'; ";
    }
    if (!empty($_POST["asset_name"]) && test_input($_POST["asset_name"]) != "any") {
        $_SESSION["search_asset_name"] = '"' . test_input($_POST["asset_name"]) . '"';
        $search_string .= $cmd_and . " a.id in (select p.people_id from people_asset p, asset o ";
        $search_string .= 'where o.asset_name like "' .  test_input($_POST["asset_name"]);
        $search_string .= '" and o.id = p.asset_id) ';
        $cmd_and = " and ";
        $message .= "Asset ID '" . test_input($_POST["asset_name"]) . "'; ";
    }
    if (!empty($_POST["occupation_id"]) && test_input($_POST["occupation_id"]) != "any") {
        $_SESSION["search_occupation_id"] = test_input($_POST["occupation_id"]);
        $search_string .= $cmd_and . " a.id in (select p.people_id from people_occupation p, occupation o ";
        $search_string .= 'where o.id = ' .  test_input($_POST["occupation_id"]);
        $search_string .= ' and o.id = p.occupation_id) ';
        $cmd_and = " and ";
        $message .= "Occupation ID '" . test_input($_POST["occupation_id"]) . "'; ";
    }
    if (!empty($_POST["company_id"]) && test_input($_POST["company_id"]) != "any") {
        $_SESSION["search_company_id"] = test_input($_POST["company_id"]);
        $search_string .= $cmd_and . " a.id in (select p.people_id from people_company p, company c ";
        $search_string .= 'where c.id = ' .  test_input($_POST["company_id"]);
        $search_string .= ' and c.id = p.company_id) ';
        $cmd_and = " and ";
        $message .= "Company ID '" . test_input($_POST["company_id"]) . "'; ";
    }
    if (!empty($_POST["checked"]) && test_input($_POST["checked"]) != "any") {
        $_SESSION["search_checked"] = test_input($_POST["checked"]);
        $search_string .= $cmd_and . "checked = '" . test_input($_POST["checked"]) . "' ";
        $cmd_and = " and ";
        $message .= "Checked '" . test_input($_POST["checked"]) . "'; ";
    }
    if (!empty($_POST["sex"]) && test_input($_POST["sex"]) != "any") {
        $_SESSION["search_sex"] = test_input($_POST["sex"]);
        $search_string .= $cmd_and . "sex = '" . test_input($_POST["sex"]) . "' ";
        $cmd_and = " and ";
        $message .= "Sex '" . test_input($_POST["sex"]) . "'; ";
    }
    if (!empty($_POST["race_id"]) && test_input($_POST["race_id"]) != 0) {
        $_SESSION["search_race"] = test_input($_POST["race_id"]);
        $search_string .= $cmd_and . "race_id = " . test_input($_POST["race_id"]) . " ";
        $cmd_and = " and ";
        $result = query("select value from race where id = " . test_input($_POST["race_id"]));
        $message .= "Race '" . $result[0]["value"] . "'";
    }
    if ($cmd_and == "") {
        $message .= "No search criteria entered - please try again. ";
        render("../page/search_form.php", ["title" => "Search for People", "message" => $message]);
    } else {
        $cmd_full = $cmd_select . $cmd_tables . $cmd_where . $search_string . $cmd_order_by . $cmd_limit;
        //$message .= $cmd_full;
        render("../page/search_results_form.php", ["title" => "All People", "search_string" => $cmd_full, "message" => $message]);
    }
} else {
    render("../page/search_form.php", ["title" => "Search for People"]);
}
?>
