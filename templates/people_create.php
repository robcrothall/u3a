<?php
    require("../inc/config.php"); 
     $_SESSION["module"] = $_SERVER["PHP_SELF"];
     $people_tab = "people";
     $title_tab = "title";
     $_SESSION["new_person"] = 0;
     //print_r($_SERVER["REQUEST_METHOD"]);
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $error   = false;
        $message = "";
        $whatsapp= "";
        if (empty($_POST["surname"])) {
            $message .= "(E) You must provide a surname.  "; 
            $error = true; 
            $surname = "Unknown";
        } else {
            $surname=test_input($_POST['surname']);
        }
        if ($surname == strtoupper($surname) | $surname == strtolower($surname)) {
            $surname = ucwords(strtolower($surname));
        }
        $_SESSION["surname"] = $surname;
        $_SESSION["search_name_start"] = $surname;
        if (empty($_POST["first_name"])) {
            $message .= "(E) You must provide a first name.  "; 
            $error = true; 
            $first_name = "Unknown";
        } else {
            $first_name=test_input($_POST['first_name']);
        }
        if ($first_name == strtoupper($first_name) | $first_name == strtolower($first_name)) {
            $first_name = ucwords(strtolower($first_name));
        }
        $first_name = trim($first_name);
        if (str_word_count($first_name) > 1) {
            $message .= "(W) There are multple words in First Name. ";
        }
        $_SESSION["first_name"] = $first_name;
        if (empty($_POST["other_name"])) {
            $other_name = "";
        } else {
            $other_name=test_input($_POST['other_name']);
        }
        if ($other_name == strtoupper($other_name) | $other_name == strtolower($other_name)) {
            $other_name = ucwords(strtolower($other_name));
        }
        $_SESSION["other_name"] = $other_name;
        if (empty($_POST["given_name"])) {
            $given_name = "";
        } else {
            $given_name = test_input($_POST['given_name']);
        }
        if ($given_name == strtoupper($given_name) | $given_name == strtolower($given_name)) {
            $given_name = ucwords(strtolower($given_name));
        }
        if ($first_name == $given_name) {
            $given_name = "";
            $message .= "(W) Given name is identical to first name - removed.  ";
        }
        $_SESSION["given_name"] = $given_name;
        $account_no = "";
        $user_id = $_SESSION['id'];
        // Do some validation
        $sql = "select id from $people_tab where surname=? and first_name=? and other_name=?";
        $rows = query($sql, $surname, $first_name, $other_name);
        if (count($rows) > 0) {
            $message .= "(E) This name already exists in our records.  ";
            $error = True;
        }
        if (empty($account_no)) {
            if (strpos($surname, ' ') === false) {
                $account_no = substr(strtoupper($surname) . '@@@', 0, 3);
            } else {
                $last_word_start = strrpos ( $surname , " ") + 1;
                $account_no = substr(strtoupper($surname) .'@@@', $last_word_start, 3);
            }
            if (strlen($first_name) > 0) {
                $account_no .= substr(strtoupper($first_name), 0, 1);
            } else {
                $account_no .= '@';
            }
            for ($x = 1; $x <= 99; $x++) {
                $y = $account_no . sprintf("%'.02d", $x);
                $rows = query("select count(*) rowCount from $people_tab where account_no =?", $y);
                $row = $rows[0];
                if ($row["rowCount"] == 0) {
                    $account_no = $y;
                    break;
                }
            }
            $message .= "(I) Account number allocated is: " . $account_no . ".  ";
            $_SESSION["account_no"] = $account_no;
        } else {
            $rows = query("select count(*) rowCount from $people_tab where account_no =?", $account_no);
            $row = $rows[0];
            if ($row["rowCount"] > 0) {
                $message .= "(W) This account code (" . $account_no . " is already in use.  ";
                $error = True;
            }
        }
        if(empty($surname)) {
            $message .= "(E) There must be a surname. ";
            $error = True;
        }
        if(empty($first_name)) {
            $message .= "(E) There must be a first name. ";
            $error = True;
        }
        if ($error === true) {
            apologize($message);
        }
        //echo "<br>" . __LINE__ . " - Account No: " . $account_no;
        $sql = "insert into $people_tab (surname, first_name, other_name, given_name, ";
        $sql .= "account_no, ";
        $sql .= "user_id) values (?, ?, ?, ?, ?, ?)";
        $rows = query($sql, 
        $surname, $first_name, $other_name, $given_name,  
        $account_no, 
        $user_id);
        //var_dump($rows);
        if ($rows !== false) {
            $message .= "$surname, $first_name inserted successfully.  Please add contact details. ";
            $_SESSION["search_name_start"] = $surname;
            $_SESSION["new_person"] = $_SESSION["inserted_row_id"];
            unset($_SESSION["surname"]);
            unset($_SESSION["first_name"]);
            unset($_SESSION["other_name"]);
            unset($_SESSION["given_name"]);
            unset($_SESSION["account_no"]);
            $people_id = $_SESSION["inserted_row_id"];
            $sql = "insert ignore into people_title (people_id, title_id, user_id) values (?, ?, ?)";
            $aTitle = $_POST["title"];
            if (!empty($aTitle)) {
                foreach ($aTitle as $title_id) {
                    $rows = query($sql, $people_id, $title_id, $_SESSION["id"]);
                    $message .= "Title ($title_id) added. ";
                }
            } else {
                $title_id = 0;
                $message .= "(W) No title selected. ";
            }
            $sql = "insert into people_occupation (people_id, occupation_id, user_id) values (?, ?, ?)";
            $Aoccupation = $_POST["occupation"];
            //var_dump("Occupation", $Aoccupation);
            if (!empty($Aoccupation)) {
                foreach ($Aoccupation as $occupation) {
                    $rows = query($sql, $people_id, $occupation, $_SESSION["id"]);
                    //echo "<br>" . __LINE__ . " - Rows: ";
                    //var_dump("Rows", $rows);
                    $message .= "Occupation ($occupation) added. ";
                }
            } else {
                $occupation_id = 0;
                $message .= "(W) No occupation selected. ";
            }
            $sql = "insert ignore into people_company (people_id, company_id, user_id) values (?, ?, ?)";
            $aCompany = $_POST["company"];
            if (!empty($aCompany)) {
                foreach ($aCompany as $company_id) {
                    $rows = query($sql, $people_id, $company_id, $_SESSION["id"]);
                    $message .= "Company ($company_id) added. ";
                }
            } else {
                $company_id = 0;
                $message .= "(W) No company selected. ";
            }
        } else {
            $message .= "(A) Failed to add the record - please call support!";
        }

        //render("../page/people_create_form.php", ["title" => "Record details of a new Person",
        //    "message" => $message]);
        render("../page/people_read_form.php", ["title" => "Display details about a Person",
            "form_id" => $people_id, "message" => $message]);
    } else {
        $_SESSION["occupation_id_select"] = 0;
        $_SESSION["new_person"] = 0;
        render("../page/people_create_form.php", ["title" => "Record details of a new Person"]);
    }

?>
