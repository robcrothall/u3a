<?php
/**
 * Program: people_delete
 * 
 * Delete an "people" record.
 * php version 5
 * 
 * @category WebPage
 * @package  Sample
 * @author   "Rob Crothall" <rob@crothall.co.za>
 * @license  GPL 1.0 or later
 * @version  GIT: <git_id>
 * @link     http://www.sprv.co.za
 */
require "../inc/config.php"; 
$_SESSION["module"] = $_SERVER["PHP_SELF"];
require "../inc/head.php";
require "../inc/body.php";
require "../inc/menu.php";
require "../inc/msg.php";
require "../inc/db_open.php";
$message = "";
echo '<h1>Delete a Person</h1>';
/*
if ((!isset($_GET['id'])) || (trim($_GET['id'] == ''))) {
    $message = 'Missing record ID - please inform SysAdmin.';
    apologize($message);
}
    $req_id = test_input($_GET['id']);
    include "../inc/db_open.php";
    $sql = "select * from people where id = " . $req_id;
    $result = mysqli_query($handle, $sql);
    if ($result <> false) {
        $row = mysqli_fetch_assoc($result);
        $people_id = $row["id"];
        $surname = $row["surname"];
        $first_name = $row["first_name"];
        $other_name = $row["other_name"];
    } else {
        $message .= "  Unable to retrieve person details - ";
        $message .= "please inform SysAdmin.";
    } */
    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $error_list = [];
        $message = "";
        $people_id = $_SESSION["people_id"];
        $rows = query("SELECT * from memberships where people_id = ?", $people_id);
        if (count($rows) > 0) {
            $error_list[] = "<br>" . __LINE__ . ": Delete memberships before deleting the person.";
        }
        $rows = query("SELECT * from address where people_id = ?", $people_id);
        if (count($rows) > 0) {
            $error_list[] = "<br>" . __LINE__ . ": Delete addresses before deleting the person.";
        }
        $rows = query("SELECT * from people_asset where people_id = ?", $people_id);
        if (count($rows) > 0) {
            $error_list[] = "<br>" . __LINE__ . ": Delete linked assets before deleting the person.";
        }
        $rows = query("SELECT * from people_company where people_id = ?", $people_id);
        if (count($rows) > 0) {
            $error_list[] = "<br>" . __LINE__ . ": Delete linked companies before deleting the person.";
        }
        $rows = query("SELECT * from people_discipline where people_id = ?", $people_id);
        if (count($rows) > 0) {
            $error_list[] = "<br>" . __LINE__ . ": Delete linked disciplines before deleting the person.";
        }
        $rows = query("SELECT * from people_docs where people_id = ?", $people_id);
        if (count($rows) > 0) {
            $error_list[] = "<br>" . __LINE__ . ": Delete linked documents before deleting the person.";
        }
        $rows = query("SELECT * from people_interventions where people_id = ?", $people_id);
        if (count($rows) > 0) {
            $error_list[] = "<br>" . __LINE__ . ": Delete linked interventions before deleting the person.";
        }
        $rows = query("SELECT * from people_news where people_id = ?", $people_id);
        if (count($rows) > 0) {
            $error_list[] = "<br>" . __LINE__ . ": Delete linked news items before deleting the person.";
        }
        $rows = query("SELECT * from people_notes where people_id = ?", $people_id);
        if (count($rows) > 0) {
            $error_list[] = "<br>" . __LINE__ . ": Delete linked notes before deleting the person.";
        }
        $rows = query("SELECT * from people_occupation where people_id = ?", $people_id);
        if (count($rows) > 0) {
            $error_list[] = "<br>" . __LINE__ . ": Delete linked occupations before deleting the person.";
        }
        $rows = query("SELECT * from med_history where people_id = ?", $people_id);
        if (count($rows) > 0) {
            $error_list[] = "<br>" . __LINE__ . ": Delete medical history before deleting the person.";
        }
        $rows = query("SELECT * from payments where people_id = ?", $people_id);
        if (count($rows) > 0) {
            $error_list[] = "<br>" . __LINE__ . ": Delete payments before deleting the person.";
        }
        $rows = query("SELECT * from people_phone where people_id = ?", $people_id);
        if (count($rows) > 0) {
            $error_list[] = "<br>" . __LINE__ . ": Delete linked phone numbers before deleting the person.";
        }
        $rows = query("SELECT * from people_related where people_id = ?", $people_id);
        if (count($rows) > 0) {
            $error_list[] = "<br>" . __LINE__ . ": Delete linked relationships before deleting the person.";
        }
        $rows = query("SELECT * from people_role where people_id = ?", $people_id);
        if (count($rows) > 0) {
            $error_list[] = "<br>" . __LINE__ . ": Delete linked roles before deleting the person.";
        }
        $rows = query("SELECT * from people_rs where people_id = ?", $people_id);
        if (count($rows) > 0) {
            $error_list[] = "<br>" . __LINE__ . ": Delete people_rs before deleting the person.";
        }
        $rows = query("SELECT * from people_skills where people_id = ?", $people_id);
        if (count($rows) > 0) {
            $error_list[] = "<br>" . __LINE__ . ": Delete linked skills before deleting the person.";
        }
        $rows = query("SELECT * from people_tasks where people_id = ?", $people_id);
        if (count($rows) > 0) {
            $error_list[] = "<br>" . __LINE__ . ": Delete linked tasks before deleting the person.";
        }
        $rows = query("SELECT * from people_trips where people_id = ?", $people_id);
        if (count($rows) > 0) {
            $error_list[] = "<br>" . __LINE__ . ": Delete linked trips before deleting the person.";
        }
        $rows = query("SELECT * from people_vehicle where people_id = ?", $people_id);
        if (count($rows) > 0) {
            $error_list[] = "<br>" . __LINE__ . ": Delete linked vehicles before deleting the person.";
        }
        $rows = query("SELECT * from people_pets where people_id = ?", $people_id);
        if (count($rows) > 0) {
            $error_list[] = "<br>" . __LINE__ . ": Delete linked pets before deleting the person.";
        }
        $rows = query("SELECT * from sensitive_text where people_id = ?", $people_id);
        if (count($rows) > 0) {
            $error_list[] = "<br>" . __LINE__ . ": Delete sensitive text before deleting the person.";
        }
        $rows = query("SELECT * from history where people_id = ?", $people_id);
        if (count($rows) > 0) {
            $error_list[] = "<br>" . __LINE__ . ": Delete history records before deleting the person.";
        }
        //var_dump($error_list);
        if (count($error_list) > 0) {
            foreach ($error_list as $error) {
                $message .= $error . "<br>";
            }
            $_SESSION["search_name_start"] = $_SESSION["surname"];
            //render("../page/people_form.php", ["error_list" => $error_list]);
        } else {
            $rows = false;
            $rows = query("DELETE from people where id = ?", $_SESSION["people_id"]);
            //var_dump(__LINE__, $rows);
            if ($rows === false) {
                $message = "<br>" . __LINE__ . ": Failed to delete the person - please call support!";
            } else {
                $message = "<br>" . __LINE__ . ": " . $_SESSION["surname"] . ", " . $_SESSION["first_name"] . " " . $_SESSION["other_name"] . " has been deleted.";
            }
            $_SESSION["search_name_start"] = $_SESSION["surname"];
            //$message = $_SESSION["surname"] . ", " . $_SESSION["first_name"] . " " . $_SESSION["other_name"] . " has been deleted.";
        }
        $_SESSION["search_name_start"] = $_SESSION["surname"];
        //render("../page/people_form.php", ["message" => $message]);
        echo "<a href='../page/people.php' class='w3-button w3-green'>Back to people</a>\r\n";
        echo "<br>";
        require "../inc/footer.php";
    } else {
        $id = $_REQUEST['id'];
        $people_id = $id;
        //render("../page/people_delete_form.php", ["title" => "Delete a person",
        //    "form_id" => "$id"]);
        $_SESSION["module"] = $_SERVER["PHP_SELF"];
        //$people_id = htmlspecialchars(strip_tags($form_id));
        $_SESSION["people_id"] = $id;
        $data = query("select a.surname, a.first_name, a.other_name, a.given_name, a.title, a.account_no, a.notes, a.user_id, a.changed, b.occupation from people a, occupation b where a.occupation_id = b.id and a.id = ?", 
                            $people_id); 
        $surname = $data[0]["surname"];
        $_SESSION["surname"] = $surname;
        $first_name = $data[0]["first_name"];
        $_SESSION["first_name"] = $first_name;
        $other_name = $data[0]["other_name"];
        $_SESSION["other_name"] = $other_name;
        $given_name = $data[0]["given_name"];
        $title = $data[0]["title"];
        $full_name = "";
        //if (!empty($title)) {$full_name .= $title . " ";}
        if (!empty($first_name)) {$full_name .= $first_name . " ";}
        if (!empty($other_name)) {$full_name .= $other_name . " ";}
        if (!empty($given_name)) {$full_name .= "(" . $given_name . ") ";}
        if (!empty($surname)) {$full_name .= $surname . " ";}
        $account_no = $data[0]["account_no"];
        $occupation = $data[0]["occupation"];
        $notes = $data[0]["notes"];
        $user_id = $data[0]["user_id"];
        $changed = $data[0]["changed"];
        $data = query("select * from users where id = ?", $user_id);
        $username = $data[0]["username"];
        $user_name_given = $data[0]["first_name"] . " " . $data[0]["surname"];
        // Check for dependencies
        $message = "";
        $error = 0;
        $rows = query("select count(*) rowCount from address where people_id =?", $people_id);
        $row = $rows[0];
        if ($row["rowCount"] > 0) {
            $message .= "<br>" . __LINE__ . ": Address lines still exist.  "; $error += 1;
            }
        $rows = query("select count(*) rowCount from history where people_id =?", $people_id);
        $row = $rows[0];
        if ($row["rowCount"] > 0) {
            $message .= "<br>" . __LINE__ . ": History lines still exist.  "; $error += 1;
            }
        $rows = query("select count(*) rowCount from med_history where people_id =?", $people_id);
        $row = $rows[0];
        if ($row["rowCount"] > 0) {
            $message .= "<br>" . __LINE__ . ": Medical history lines still exist.  "; $error += 1;
            }
        $rows = query("select count(*) rowCount from payments where people_id =?", $people_id);
        $row = $rows[0];
        if ($row["rowCount"] > 0) {
            $message .= "<br>" . __LINE__ . ": Payment lines still exist.  "; $error += 1;
            }
        $rows = query("select count(*) rowCount from people_asset where people_id =?", $people_id);
        $row = $rows[0];
        if ($row["rowCount"] > 0) {
            $message .= "<br>" . __LINE__ . ": Asset links still exist.  "; $error += 1;
            }
        $rows = query("select count(*) rowCount from people_related where people_id =? or related_id =?", $people_id, $people_id);
        $row = $rows[0];
        if ($row["rowCount"] > 0) {
            $message .= "<br>" . __LINE__ . ": Relationships still exist.  "; $error += 1;
            }
        $rows = query("select count(*) rowCount from people_rs where people_id =? or rs_id =?", $people_id, $people_id);
        $row = $rows[0];
        if ($row["rowCount"] > 0) {
            $message .= "<br>" . __LINE__ . ": R&S links still exist.  "; $error += 1;
            }
        $rows = query("select count(*) rowCount from people_skills where people_id =?", $people_id);
        $row = $rows[0];
        if ($row["rowCount"] > 0) {
            $message .= "<br>" . __LINE__ . ": Skill links still exist.  "; $error += 1;
            }
        $rows = query("select count(*) rowCount from people_vehicle where people_id =?", $people_id);
        if ($rows[0]["rowCount"] > 0) {
            $message .= "<br>" . __LINE__ . ": Vehicle links still exist.  "; $error += 1;
        }
        $rows = query("select count(*) rowCount from memberships where people_id =?", $people_id);
        if ($rows[0]["rowCount"] > 0) {
            $message .= "<br>" . __LINE__ . ": Memberships still exist.  "; $error += 1;
        }
        $rows = query("select count(*) rowCount from people_company where people_id =?", $people_id);
        if ($rows[0]["rowCount"] > 0) {
            $message .= "<br>" . __LINE__ . ": Company links still exist.  "; $error += 1;
        }
        $rows = query("select count(*) rowCount from people_vehicle where people_id =?", $people_id);
        if ($rows[0]["rowCount"] > 0) {
            $message .= "<br>" . __LINE__ . ": Vehicle links still exist.  "; $error += 1;
        }
        $rows = query("select count(*) rowCount from people_trips where people_id =?", $people_id);
        if ($rows[0]["rowCount"] > 0) {
            $message .= "<br>" . __LINE__ . ": Trip links still exist.  "; $error += 1;
        }
        $rows = query("select count(*) rowCount from people_tasks where people_id =?", $people_id);
        if ($rows[0]["rowCount"] > 0) {
            $message .= "<br>" . __LINE__ . ": Task links still exist.  "; $error += 1;
        }
        $rows = query("select count(*) rowCount from people_pets where people_id =?", $people_id);
        if ($rows[0]["rowCount"] > 0) {
            $message .= "<br>" . __LINE__ . ": Pet links still exist.  "; $error += 1;
        }
        $rows = query("select count(*) rowCount from people_notes where people_id =?", $people_id);
        if ($rows[0]["rowCount"] > 0) {
            $message .= "<br>" . __LINE__ . ": Note links still exist.  "; $error += 1;
        }
        $rows = query("select count(*) rowCount from people_news where people_id =?", $people_id);
        if ($rows[0]["rowCount"] > 0) {
            $message .= "<br>" . __LINE__ . ": News links still exist.  "; $error += 1;
        }
        $rows = query("select count(*) rowCount from people_interventions where people_id =?", $people_id);
        if ($rows[0]["rowCount"] > 0) {
            $message .= "<br>" . __LINE__ . ": Intervention links still exist.  "; $error += 1;
        }
        $rows = query("select count(*) rowCount from people_discipline where people_id =?", $people_id);
        if ($rows[0]["rowCount"] > 0) {
            $message .= "<br>" . __LINE__ . ": Discipline links still exist.  "; $error += 1;
        }
        $rows = query("select count(*) rowCount from people_docs where people_id =?", $people_id);
        if ($rows[0]["rowCount"] > 0) {
            $message .= "<br>" . __LINE__ . ": Document links still exist.  "; $error += 1;
        }
        $rows = query("select count(*) rowCount from people_phone where people_id =?", $people_id);
        if ($rows[0]["rowCount"] > 0) {
            $message .= "<br>" . __LINE__ . ": Phone links still exist.  "; $error += 1;
        }
        $rows = query("select count(*) rowCount from people_occupation where people_id =?", $people_id);
        if ($rows[0]["rowCount"] > 0) {
            $message .= "<br>" . __LINE__ . ": Occupation links still exist.  "; $error += 1;
        }
        $rows = query("select count(*) rowCount from people_skills where people_id =?", $people_id);
        if ($rows[0]["rowCount"] > 0) {
            $message .= "<br>" . __LINE__ . ": Skill links still exist.  "; $error += 1;
        }
        $rows = query("select count(*) rowCount from people_role where people_id =?", $people_id);
        if ($rows[0]["rowCount"] > 0) {
            $message .= "<br>" . __LINE__ . ": Role links still exist.  "; $error += 1;
        }
        $rows = query("select count(*) rowCount from sensitive_text where people_id =?", $people_id);
        if ($rows[0]["rowCount"] > 0) {
            $message .= "<br>" . __LINE__ . ": Sensitive text still exists.  "; $error += 1;
        }
    ?>
    <h2>This person is about to be deleted!</h2>
      <div class="container">
      <form action="../page/people_delete.php" method="post">
       <table border="0" cellpadding="0" cellspacing="10" width="100%">
              <tr>
                    <td align="right" width="30%">Person name:</td>
                    <td width="2%"></td>
                    <td align="left" width="70%"><?php echo $full_name; ?></td>
              </tr>
              <tr>
                    <td align="right" width="30%">Account No:</td>
                    <td width="2%"></td>
                    <td align="left" width="70%"><?php echo $account_no; ?></td>
              </tr>
              <tr>
                    <td align="right" width="30%">Occupation:</td>
                    <td width="2%"></td>
                    <td align="left" width="70%"><?php echo $occupation; ?></td>
              </tr>
              <tr>
                    <td align="right" width="25%">Changed by:</td>
                    <td width="2%"></td>
                    <td align="left" width="70%"><?php echo $username . ' - ' . $user_name_given; ?></td>
              </tr>
              <tr>
                    <td align="right" width="25%">Changed on:</td>
                    <td width="2%"></td>
                    <td align="left" width="70%"><?php echo $changed; ?></td>
              </tr>
              <tr>
                    <td align="right" width="25%">Notes:</td>
                    <td width="2%"></td>
                    <td align="left" width="70%"><?php echo $notes; ?></td>
              </tr>
        </table> 
    
       <div class="form-actions">
    <?php
        if ($error == 0) {
            echo "<input type='submit' value='Delete' class='w3-button w3-red' />";
        }
        else {
            echo $message . "<br>";
        }
    ?>
              <a href='../page/people.php' class='w3-button w3-green'>Back to people</a>
       </div>
      </div>
    </form>
    <?php
    }
    require "../inc/footer.php";
    ?>