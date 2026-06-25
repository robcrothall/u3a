<?php
    require("../inc/config.php"); 
    $_SESSION["module"] = htmlspecialchars($_SERVER["PHP_SELF"]);
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $rec_id = $_SESSION["rec_id"];
            $text_type = test_input($_POST['text_type']);
            $value = test_input($_POST['value']);
            $user_id = test_input($_SESSION['id']);
            // Do some validation
            $errMsg = "";
            if (empty($value)) {$errMsg .= "The sensitive text cannot be empty. ";}
            if (!empty($errMsg)) {apologize($errMsg);}
            $encrypted_text = my_encrypt($value);
            //$rows = query("update history set event_date=?, people_id = ?, notes=?, user_id=?, changed=CURRENT_TIMESTAMP() where id=?",
            //        $event_date, $_SESSION["selected_people_id"], $notes, $user_id, $rec_id);
            $sql = "update sensitive_text set text_type=?, encrypted_text=?, user_id=? where id=?";
            $rows = query($sql, $text_type, $encrypted_text, $user_id, $_SESSION["selected_people_id"]);
                If ($rows === false)
                {
                    print_r($rec_id);
                    print_r($proc_date);
                    print_r($proc_id);
                    print_r($value);
                    print_r($price);
                    print_r($comment);
                    print_r($user_id);
                    print_r($rows);
                    apologize("Update failed.  Please call support.");
                }
                else 
                {
                    render("../page/popi_data_update_form.php", ["title" => "Update POPI data", "form_id" => "$rec_id", "message" => "Update was successful."]);        
                }
    }
    else
    {
        $id = null;
        if (!empty($_GET['id'])) {
              $id = $_GET['id'];
        }
        $_SESSION["rec_id"] = $id;
      render("../page/popi_data_update_form.php", ["title" => "Update sensitive data",
            "form_id" => "$id", "message" => ""]);
    }

?>
