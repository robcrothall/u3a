<?php
/**
 * Program: config.php
 * 
 * Standard configuration
 *  
 * PHP version 7.1
 * 
 * @category WebPage
 * @package  Sample
 * @author   "Rob Crothall" <rob@crothall.co.za>
 * @license  GPL 1.0 or later
 * @version  GIT: <git-id>
 * @link     http://www.robcrothall.co.za
 */
// display errors, warnings, and notices
ini_set("display_errors", true);
error_reporting(E_ALL);
// enable sessions
session_start();  // Moved to index.php
$_SESSION["debug"] = false;
if ($_SESSION["debug"]) {
    echo "<br>Session in config.php within " . $_SERVER["PHP_SELF"] . "<br>";
    var_dump($_SESSION);
}
// requirements
date_default_timezone_set("Africa/Johannesburg");
require "../inc/constants.php";
require "../inc/functions.php";

// Keep track of function usage
$user_id = 0;
if (!empty($_SESSION["id"])) {
    $user_id = $_SESSION["id"];
}
if ($user_id > 0) {
    $sql = 'insert into function_log (function, user_id) ';
    $sql .= 'values ("' . $_SERVER["PHP_SELF"] . '", ' . $user_id . ")";
    //var_dump($sql);
    //echo "<br>";
    $rows = query($sql);
    $sql = "delete from function_log where changed < ";
    $sql .= date("Y-m-d", strtotime("-100"));
    $rows = query($sql);
}
$_SESSION["id"] = $user_id;
// require authentication for most pages
if (!preg_match("{(?:login|logout|contact|index)\.php$}", $_SERVER["PHP_SELF"])) {
    if (empty($_SESSION["id"])) {
        echo "<br>session - config.php<br>";
        var_dump($_SESSION);
        //redirect("../page/login.php");
    }
}
?>
