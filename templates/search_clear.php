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
    $message = "Search criteria have been cleared";
    render("../page/search_form.php", ["title" => "Search for People", "message" => $message]);
