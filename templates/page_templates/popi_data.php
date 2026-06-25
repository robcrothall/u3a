<?php
/**
 * Program: popi_data.php
 * 
 * Display sensitive data covered by the POPI Act and GDPR
 * php version 7.2.10
 * 
 * @category WebPage
 * @package  Sample
 * @author   "Rob Crothall" <rob@crothall.co.za>
 * @license  GPL 1.0 or later
 * @version  GIT: <git_id> 
 * @link     http://www.sprv.co.za
 * @PHP      7.1
 */

// configuration
require "../inc/config.php"; 
$_SESSION["module"] = $_SERVER["PHP_SELF"];
// if form was submitted
$requested = $_SERVER["PHP_SELF"];
if (!check_role("HR")) {
    apologize(
        "You are not authorised to perform this function - " . 
        "please contact SysAdmin"
    );
} 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    render("../page/construction_form.php");
} else {
    if (!empty($_SESSION["selected_people_id"])) {
        if ($_SESSION["selected_people_id"] == 0) {
            apologize("You must select a person before looking at sensitive data.");
        }
    } else {
        apologize("You must select a person before looking at sensitive data.");
    }
    render("../page/popi_data_form.php", ["title" => "Sensitive Data"]);
}
?>
