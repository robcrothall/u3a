<?php
/**
 * Program: people_update.php
 * 
 * Edit a data row in people.
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
if ($_SERVER["REQUEST_METHOD"] <> "POST") {
    // we need to display the form, populated from the database
    include "../inc/db_open.php";
    $errorList = array();
    $id = test_input($_GET["id"]);
    //echo "<br>ID = $id";
    if (trim($id) == '') {
        die("No ID specified - please inform SysAdmin.");
    }
    $_SESSION["people_id"] = $id;
    $_SESSION["selected_people_id"] = $id;
    $sql = "select * ";
    $sql .= "from people where id = " . $id;
    $result = mysqli_query($handle, $sql)
        or die("Error in query: $sql. " . mysqli_error($handle));
    $row = $result->fetch_array();
    if (count($row) == 0) {
        die("No result returned from database - please advise SysAdmin.");
    }
    //var_dump(($row));
    // move all row fields into variables
    //$id = $row["id"];
    $surname = $row["surname"];
    $_SESSION["search_name_start"] = $surname;
    //If surname is all upper or lower case, adjust it
    if ($surname == strtoupper($surname) or $surname == strtolower($surname)) {
        $surname = ucwords(strtolower($surname));
        $errorList[] = "Case of surname has been adjusted. ";
    }
    $first_name = $row["first_name"];
    if (empty($first_name)) {
        $errorList[] = "Please add the first name. ";
    } else {
        if ($first_name == strtoupper($first_name)
           or $first_name == strtolower($first_name)
        ) {
            $first_name = ucwords(strtolower($first_name));
            $errorList[] = "Case of first name has beed adjusted. ";
        }
    }
    $other_name = $row["other_name"];
    if (empty($other_name)) {
        $errorList[] = "Please add any other names. ";
    } else {
        if ($other_name == strtoupper($other_name)
           or $other_name == strtolower($other_name)
        ) {
            $other_name = ucwords(strtolower($other_name));
            $errorList[] = "Case of other names has beed adjusted. ";
        }
    }
    $given_name = $row["given_name"];
    if (empty($given_name)) {
        $errorList[] = "Given name is empty. First name will be used. ";
    } else {
        if ($given_name == strtoupper($given_name)
           or $given_name == strtolower($given_name)
        ) {
            $given_name = ucwords(strtolower($given_name));
            $errorList[] = "Case of given name has beed adjusted. ";
        }
    }
    $account_no = $row["account_no"];
    $checked = $row["checked"];
    $user_id = $row["user_id"];
    $changed = $row["changed"];
    require "../inc/msg.php";
    ?>
<h1>Change People Details</h1>
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
<input type="hidden" name="id" value="<?php echo $id; ?>">
<input type="submit" name="submit" value="Save" 
        class='w3-button w3-green'/>&nbsp;
<a class="w3-button w3-green" href="../page/people.php">Return to people list</a>
&nbsp;
<a class="w3-button w3-green" href="../page/people_read.php?id=<?php echo $id; ?>">Read person details</a>
&nbsp;
<?php
if (check_role("HR") or check_role("S_Staff")) {
    echo '<a class="w3-button w3-green" ';
    echo 'href="../page/popi_data.php">Sensitive Data</a>&nbsp;';
}
?>
<table cellspacing="5" cellpadding="5">
<tr>
    <td valign="top">Surname</td>
    <td><input size="50" maxlength="50" type="text" name="surname"
        required autofocus value="<?php echo $surname; ?>"></td>
</tr>
<tr>
    <td valign="top">First name</td>
    <td><input size="50" maxlength="50" type="text" name="first_name"
        required value="<?php echo $first_name; ?>"></td>
</tr>
<tr>
    <td valign="top">Other names</td>
    <td><input size="50" maxlength="50" type="text" name="other_name"
        value="<?php echo $other_name; ?>"></td>
</tr>
<tr>
    <td valign="top">Given name</td>
    <td><input size="50" maxlength="50" type="text" name="given_name"
        value="<?php echo $given_name; ?>"></td>
</tr>
<!--
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

-->
<tr>
    <td valign="top">Title</td>
    <td>
<?php
$sql = "select id, title from title ";
$sql .= 'where title not like "% and %" ';
$sql .= "order by title";
$titles = query($sql);
foreach ($titles as $t) {
    $tsql = "select title_id from people_title ";
    $tsql .= "where people_id = $id and title_id = " . $t["id"];
    $tresult = mysqli_query($handle, $tsql)
        or die("Error in query: $tsql. " . mysqli_error($handle));
    $trow = $tresult->fetch_array();
    //var_dump(__LINE__, $trow);
    //echo "<br>" . __LINE__ . " - Title: " . $t["title"];
    if (is_null($trow)) {
        $selected = "";
    } else {
        $selected = " selected";
    }
    //echo "<option value=" . $t["id"] . $selected . ">";
    //echo $t["title"] . "</option>\n";
    echo '<input type="checkbox" id="' . $t["id"] . '" name="' . "title[]"
        . '" value="' . $t["id"] . '"';
    if ($selected == " selected") {
        echo ' checked';
    }
    echo '>&nbsp;<label for="' . $t["id"] . '">' . $t["title"] . '</label>&emsp;&emsp;' . "\r\n";
}
?>
        </select>
    </td>
</tr>
<tr>
    <td valign="top">Occupation</td>
    <td>
<?php
$sql = "select id, occupation from occupation ";
$sql .= "order by occupation";
$occupations = query($sql);
foreach ($occupations as $t) {
    $tsql = "select occupation_id from people_occupation ";
    $tsql .= "where people_id = $id and occupation_id = " . $t["id"];
    $tresult = mysqli_query($handle, $tsql)
        or die("Error in query: $tsql. " . mysqli_error($handle));
    $trow = $tresult->fetch_array();
    if (is_null($trow)) {
        $selected = "";
    } else {
        $selected = " selected";
    }
    echo "<input type='checkbox' id='" . $t["id"] . "' name='" . "occupation[]"
        . "' value='" . $t["id"] . "'";
    if ($selected == " selected") {
        echo ' checked';
    }
    echo '>&nbsp;<label for="' . $t["id"] . '">' . $t["occupation"] . '</label>&emsp;&emsp;' . "\r\n";
    //echo "<option value=" . $t["id"] . $selected . ">";
    //echo $t["occupation"] . "</option>\n";
}
?>
        </select>
    </td>
</tr>
<tr>
    <td valign="top">Companies</td>
    <td>
<?php
$sql = "select id, co_name from company ";
$sql .= "order by co_name";
$companies = query($sql);
foreach ($companies as $t) {
    $tsql = "select company_id from people_company ";
    $tsql .= "where people_id = $id and company_id = " . $t["id"];
    $tresult = mysqli_query($handle, $tsql)
        or die("Error in query: $tsql. " . mysqli_error($handle));
    $trow = $tresult->fetch_array();
    if (is_null($trow)) {
        $selected = "";
    } else {
        $selected = " selected";
    }
    echo "<input type='checkbox' id='" . $t["id"] . "' name='" . "company[]"
        . "' value='" . $t["id"] . "'";
    if ($selected == " selected") {
        echo ' checked';
    }
    echo '>&nbsp;<label for="' . $t["id"] . '">' . $t["co_name"] . '</label>&emsp;&emsp;' . "\r\n";
}
?>
        </select>
    </td>
</tr>
<tr>
    <td valign="top">Account No</td>
    <td><input size="10" maxlength="10" type="text" name="account_no"
        value="<?php echo $account_no; ?>"></td>
</tr>
<tr>
    <td>Checked</td>
    <td>
        <select name="checked">
<?php
$checked_status = ["N","Y","Query"];
foreach ($checked_status as $status) {
    if ($checked == $status) {
        $selected = " selected";
    } else {
        $selected = "";
    }
    echo "<option value=$status $selected>$status</option>\n";
}
?>
        </select>
    </td>
</tr> 
<tr>
    <td colspan=2><input type="submit" name="submit" value="Save" 
        class='w3-button w3-green'/>&nbsp;
        <a class="w3-button w3-green" href="../page/people.php">
            Return to people list</a>
        &nbsp;
        <a class="w3-button w3-green" 
        href="../page/people_read.php?id=<?php echo $id; ?>">Read person details</a>
        &nbsp;
    </td>
</tr>
</table>
</form>
<?php
if (sizeof($errorList) > 0) {
    $message = 'The following warnings were encountered:<br>';
    $message .= '<ul>';
    for ($x=0; $x<sizeof($errorList); $x++) {
        $message .= "<li>$errorList[$x]";
    }
    $message .= '</ul>';    
}

include "../inc/msg.php";
include "../inc/footer.php";
} else {
    include "../inc/db_open.php";
    include "../inc/msg.php";
    // We need to validate and update data
    echo '<h1>Edit a People record</h1>';
    $errorList = array();
    $error = false;
    $id = test_input($_POST["id"]);
    if (trim($id) == '') {
        die("No ID specified - please inform SysAdmin.");
    }
    $_SESSION["people_id"] = $id;
    $_SESSION["selected_people_id"] = $id;
    $sql = "select * ";
    $sql .= "from people where id = " . $id;
    $result = mysqli_query($handle, $sql)
        or die("Error in query: $sql. " . mysqli_error($handle));
    $row = $result->fetch_array();
    if (count($row) == 0) {
        die(__LINE__ . " - No result returned from database - please advise SysAdmin.");
    }
    //var_dump(($row));
    // move all row fields into variables
    //$id = $row["id"];
    if (!empty($_POST["surname"])) {
        $surname = test_input($_POST["surname"]);
    } else {
        $surname = $row["surname"];
    }
    $_SESSION["search_name_start"] = $surname;
    //If surname is all upper or lower case, adjust it
    if ($surname == strtoupper($surname) or $surname == strtolower($surname)) {
        $surname = ucwords(strtolower($surname));
        $errorList[] = "Case of surname has been adjusted. ";
    }
    if (!empty($_POST["first_name"])) {
        $first_name = test_input($_POST["first_name"]);
    } else {
        $first_name = $row["first_name"];
    }
    if (empty($first_name)) {
        $errorList[] = "Please add the first name. ";
        $error = true;
    } else {
        if ($first_name == strtoupper($first_name)
           or $first_name == strtolower($first_name)
        ) {
            $first_name = ucwords(strtolower($first_name));
            $errorList[] = "Case of first name has beed adjusted. ";
        }
    }
    if (!empty($_POST["other_name"])) {
        $other_name = test_input($_POST["other_name"]);
    } else {
        $other_name = $row["other_name"];
    }
    if (empty($other_name)) {
        $errorList[] = "Please add any other names. ";
    } else {
        if ($other_name == strtoupper($other_name)
           or $other_name == strtolower($other_name)
        ) {
            $other_name = ucwords(strtolower($other_name));
            $errorList[] = "Case of other names has beed adjusted. ";
        }
    }
    if (!empty($_POST["given_name"])) {
        $given_name = test_input($_POST["given_name"]);
    } else {
        $given_name = $row["given_name"];
    }
    if (empty($given_name)) {
        $errorList[] = "Given name is empty. First name will be used. ";
    } else {
        if ($given_name == strtoupper($given_name)
           or $given_name == strtolower($given_name)
        ) {
            $given_name = ucwords(strtolower($given_name));
            $errorList[] = "Case of given name has beed adjusted. ";
        }
    }
    $account_no = $row["account_no"];
    if (!empty($_POST["checked"])) {
        $checked = test_input($_POST["checked"]);
    } else {
        $checked = $row["checked"];
    }
    $user_id = $_SESSION["id"];
    require "../inc/msg.php";
    if ($error == false) {
        $sql = "update people ";
        $sql .= "set surname='" . $surname . "'";
        $sql .= ", first_name ='" . $first_name . "'";
        $sql .= ", other_name ='" . $other_name . "'";
        $sql .= ", given_name ='" . $given_name . "'";
        $sql .= ", checked ='" . $checked . "'";
        $sql .= ", user_id='" . $user_id . "'";
        $sql .= " where id = $id";
        $result = mysqli_query($handle, $sql) 
            or die(__LINE__ . " - Error in query: $sql. " . mysqli_error($handle));
        $message = "Update of person details successful. ";
        $post_title = isset($_POST["title"]) ? $_POST["title"] : [];
        $tsql = "delete from people_title ";
        $tsql .= "where people_id = $id";
        $tresult = mysqli_query($handle, $tsql)
            or die("Error in query: $tsql. " . mysqli_error($handle));
        $message .= "<br>All titles deleted. ";
        if (count($post_title) > 0) {
            //var_dump(__LINE__, "POST - title", $post_title);
            foreach ($post_title as $title_id) {
                $tsql = "insert into people_title (people_id, title_id, user_id) ";
                $tsql .= "values ($id, $title_id, $user_id)";
                $tresult = mysqli_query($handle, $tsql)
                    or die("Error in query: $tsql. " . mysqli_error($handle));
                $tsql = "select title from title where id = $title_id";
                $tresult = mysqli_query($handle, $tsql)
                    or die("Error in query: $tsql. " . mysqli_error($handle));
                $trow = $tresult->fetch_array();
                //var_dump(__LINE__, $trow);
                $message .= '<br>Title "' . $trow["title"] . '" added. ';
                //echo "<br>" . __LINE__ . " - Title: "
                //$message .= "<br>Title (" . $trow[0]["title"] . ") added. ";
            }
        } else {
            //echo "<br>" . __LINE__ . " - No titles selected.";
            $message .= "<br>(W) No title selected. ";
        }
        // Update occupation
        $post_occupation = isset($_POST["occupation"]) ? $_POST["occupation"] : [];
        $tsql = "delete from people_occupation ";
        $tsql .= "where people_id = $id";
        $tresult = mysqli_query($handle, $tsql)
            or die("Error in query: $tsql. " . mysqli_error($handle));
        $message .= "<br>All occupations deleted for this person. ";
        if (count($post_occupation) > 0) {
            //var_dump(__LINE__, "POST - occupation", $post_occupation);
            foreach ($post_occupation as $occupation_id) {
                $tsql = "insert into people_occupation (people_id, occupation_id, user_id) ";
                $tsql .= "values ($id, $occupation_id, $user_id)";
                $tresult = mysqli_query($handle, $tsql)
                    or die("Error in query: $tsql. " . mysqli_error($handle));
                $tsql = "select occupation from occupation where id = $occupation_id";
                $tresult = mysqli_query($handle, $tsql)
                    or die("Error in query: $tsql. " . mysqli_error($handle));
                $trow = $tresult->fetch_array();
                $message .= '<br>Occupation "' . $trow["occupation"] . '" added. ';
            }
        } else {
            //echo "<br>" . __LINE__ . " - No occupations selected.";
            $message .= "<br>(W) No occupation selected. ";
        }
        // Update company
        $post_company = isset($_POST["company"]) ? $_POST["company"] : [];
        $tsql = "delete from people_company ";
        $tsql .= "where people_id = $id";
        $tresult = mysqli_query($handle, $tsql)
            or die("Error in query: $tsql. " . mysqli_error($handle));
        $message .= "<br>All companies deleted for this person. ";
        if (count($post_company) > 0) {
            //var_dump(__LINE__, "POST - company", $post_company);
            foreach ($post_company as $company_id) {
                $tsql = "insert into people_company (people_id, company_id, user_id) ";
                $tsql .= "values ($id, $company_id, $user_id)";
                $tresult = mysqli_query($handle, $tsql)
                    or die("Error in query: $tsql. " . mysqli_error($handle));
                $tsql = "select co_name from company where id = $company_id";
                $tresult = mysqli_query($handle, $tsql)
                    or die("Error in query: $tsql. " . mysqli_error($handle));
                $trow = $tresult->fetch_array();
                $message .= '<br>Company "' . $trow["co_name"] . '" added. ';
            }
        } else {
            //echo "<br>" . __LINE__ . " - No companies selected.";
            $message .= "<br>(W) No company selected. ";
        }
        // Update account number
        if (isset($_POST["account_no"]) and !empty($_POST["account_no"])) {
            $account_no = test_input($_POST["account_no"]);
        } else {
            $account_no = $row["account_no"];
        }
        if ($account_no == $row["account_no"]) {
            $message .= "<br>Account number not changed. ";
        } else {
            $message .= "<br>Account number changed from " . $row["account_no"] . " to $account_no. ";
            $tsql = "update people set account_no = '$account_no' where id = $id";
            $tresult = mysqli_query($handle, $tsql)
                or die("Error in query: $tsql. " . mysqli_error($handle));
            $message .= "<br>Account number updated to $account_no. ";
        }
        // Update checked status
        if (isset($_POST["checked"]) and !empty($_POST["checked"])) {
            $checked = test_input($_POST["checked"]);
        } else {
            $checked = $row["checked"];
        }
        if ($checked == $row["checked"]) {
            $message .= "<br>Checked status not changed. ";
        } else {
            $message .= "<br>Checked status changed from " . $row["checked"] . " to $checked. ";
            $tsql = "update people set checked = '$checked' where id = $id";
            $tresult = mysqli_query($handle, $tsql)
                or die("Error in query: $tsql. " . mysqli_error($handle));
            $message .= "<br>Checked status updated to $checked. ";
    }
        // mysqli_free_result($result);
    } else {
        echo 'The update was NOT successful.<br>';
        echo 'The following issues were encountered:<br>';
        echo '<ul>';
        for ($x=0; $x<sizeof($errorList); $x++) {
            echo "<li>$errorList[$x]";
        }
        echo '</ul>';    
    }
    include "../inc/footer.php";
    echo '<br><a class="w3-button w3-green" href="../page/people.php">';
    echo 'Return to people list</a>&nbsp';
    echo '<a href="' . $_SERVER["PHP_SELF"] . '?id=' . $id . '" class="w3-button w3-green">';
    echo 'Try again</a>';
    //include "../inc/msg.php";
}
?>
