<?php
    require("../inc/config.php"); 
     $_SESSION["module"] = $_SERVER["PHP_SELF"];
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // Validate fields
        $error = false;
        $message = "";
        $people_id = $_SESSION["selected_people_id"];
        $text_type = test_input($_POST['text_type']);
        $clear_text = test_input($_POST['clear_text']);
        $encrypted_text = my_encrypt($clear_text);
        $user_id = $_SESSION["id"];
        if($error == false) 
        {
            $sql = "insert into sensitive_text ";
            $sql .= "(people_id, text_type, encrypted_text, user_id) ";
            $sql .= "values (?, ?, ?, ?)";
            $rows = query($sql, $people_id, $text_type, $encrypted_text, $user_id);
            if (!$rows == false) {
                $message .= "Failed to add the sensitive data record - please call support!  ";
            } else {
                $message .= "Record inserted successfully.  ";
            }
        }
        render("../page/popi_data_add_form.php", ["title" => "Record Details of sensitive data", "message" => "$message"]);
    } else {
      render("../page/popi_data_add_form.php", ["title" => "Record Details of sensitive data"]);
    }
?>
