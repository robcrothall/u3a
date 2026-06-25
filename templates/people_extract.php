<?php
/**
 * Program group_extract
 * 
 * Extract contact details for people in a group
 * 
 * PHP version 7.1
 * 
 * @category WebPage
 * @package  Sample
 * @author   "Rob Crothall" <rob@crothall.co.za>
 * @license  GPL 1.0 or later
 * @version  GIT: <git_id>
 * @link     http://www.sprv.co.za
 * @PHP      7.1
 */
require "../inc/config.php"; 
$_SESSION["module"] = $_SERVER["PHP_SELF"];
require "../inc/head.php";
require "../inc/body.php";
require "../inc/menu.php";
require "../inc/msg.php";
if ($_SERVER["REQUEST_METHOD"] <> "POST") {
    include "../inc/db_open.php";
    if (!check_role("ADMIN")) {
        apologize("You are not authorised to extract this data - Please consult SysAdmin.");
    }
    echo '<h1>Settlers Park People Contact Extract</h1>' . "\r\n";
    echo '<h2>Please select the group that you want to extract:</h2>' . "\r\n";
    ?>
    <form action="../page/people_extract2.php" method="post">
    <table class='w3-table-all'>
        <tr>
            <td><b>Group:</b></td>
            <td>
<?php
    $sql = 'select id, `group_name` from `groups` ';
    $sql .= 'order by `group_name`';
    $rows = query($sql);
    foreach ($rows as $r) {
        echo '<input type="radio" id="' . $r["id"] . '" name="' . "group_id" 
        . '" value="' . $r["id"] . '"';
        echo '>&nbsp;<label for="' . $r["id"] . '">' . $r["group_name"] . '</label>&emsp;&emsp;' . "\r\n";
    }
?>
            </td>
        </tr> 
<tr>
    <td colspan=2>
        <input type="submit" name="submit" value="Submit" 
            class="w3-button w3-green"/>&nbsp;
    </td>

</tr>
</table>
</form>
    <?php
    $message = "Note that this extract may take up to 60 seconds to complete.";
    require "../inc/footer.php";
} else {
    $group_id = test_input($_POST["group_id"]);
    $sql = "select group_name from `groups` where id = $group_id";
    $rows = query($sql);
    $group_name = $rows[0]["group_name"];
    echo '<h1>Settlers Park People Contact Extract</h1>' . "\r\n";
    echo '<h2>Group: ' . $group_name . '</h2>' . "\r\n";
    $message = "Extracting contact details for people in group: " . $group_name;
    //var_dump("group_id=", $group_id);
    //var_dump($_POST);
    include "../inc/msg.php";
    if ((!isset($_POST['group_id'])) || (trim($_POST['group_id'] == ''))) {
        apologize('Missing record ID - please inform SysAdmin.');
    }
    if (file_exists("../data/group_extract.csv")) { 
        unlink("../data/group_extract.csv"); 
    }
    $fp = fopen("../data/group_extract.csv", 'w');
    $trans = "Full_Name\tSurname\tFirst_Name\tOther_Name\tGiven_Name\tTitle\tStatus\tAccount_No\t";
    $trans .= "Home_Phone\tMobile\tWork_Phone\tHome_Email\tWork_Email\tCottage\tID_No\tBirth_Date\tWedding_Date\n";
    fwrite($fp, $trans);
    //echo '<h1>Settlers Park People Contact Details</h1>';
    //echo '<ul>';
    ?>
    <p>Please download the CSV file of contact details for people.  Remember to import phone numbers from the CSV file as "type text".
    </p>
    <a href="../data/group_extract.csv" class="w3-button w3-green">Download</a>
    <?php
    $errcount = 0;
    /*$sql = "select first_name, other_name, given_name, surname, title, account_no,";
    $sql .= " home_phone, mobile_phone, work_phone, work_email, company_id, ";
    $sql .= " home_email, cottage, cottage_id, status";
    $sql .= " from people";
    $sql .= " where status != 'Constant'";
    $sql .= " order by surname, cottage, first_name"; */
    $sql = "select id as people_id, first_name, other_name, given_name, surname, account_no ";
    $sql .= " from people";
    $sql .= " where id in (select people_id from memberships where group_id = $group_id)";
    //$sql .= " and id not in (select people_id from memberships where group_id = 27)";
    $sql .= " order by surname, first_name";
    $rows = query($sql);
    foreach ($rows as $row) {
        $people_id = $row["people_id"];
        if (!empty($row["first_name"])) {
            $first_name = ucwords(strtolower($row["first_name"]));
        } else {
            $first_name = " ";
        }
        $other_name = ucwords(strtolower($row["other_name"] ?? " "));
        $given_name = ucwords(strtolower($row["given_name"] ?? " "));
        $surname = ucwords(strtolower($row["surname"] ?? " "));
        if ($first_name == $given_name) {
            $given_name = '';
        } 
        $full_name = full_name($people_id);
        $account_no = $row["account_no"];
        $sql = "select t.title from title t, people_title pt ";
        $sql .= " where pt.people_id = $people_id and pt.title_id = t.id";
        $rows = query($sql);
        $title = '';
        foreach ($rows as $row) {
            if (strlen($title) > 0) {
                $title .= ' ';
            }
            $title .= $row["title"];
        }
        $sql = "select co_name from people_company pc, company c where people_id = $people_id and pc.company_id = c.id";
        $rows = query($sql);
        $company = '';
        foreach ($rows as $row) {
            if (strlen($company) > 0) {
                $company .= '; ';
            }
            $company .= $row["co_name"];
        }
        $sql = "select encrypted_text from sensitive_text st, sensitive_text_type stt where st.people_id = $people_id and stt.text_description = 'Phone - Home' ";
        $sql .= " and st.text_type = stt.id";
        $rows = query($sql);
        if (count($rows) > 0) {
            $home_phone = my_decrypt($rows[0]["encrypted_text"]);
        } else {
            $home_phone = '';
        }
        $sql = "select encrypted_text from sensitive_text st, sensitive_text_type stt where st.people_id = $people_id and stt.text_description = 'Phone - Mobile' ";
        $sql .= " and st.text_type = stt.id";
        $rows = query($sql);
        if (count($rows) > 0) {
            $mobile_phone = my_decrypt($rows[0]["encrypted_text"]);
        } else {
            $mobile_phone = '';
        }
        $sql = "select encrypted_text from sensitive_text st, sensitive_text_type stt where st.people_id = $people_id ";
        $sql .= "and stt.text_description in ('Phone - Work Switchboard', 'Phone - Work Direct')";
        $sql .= " and st.text_type = stt.id";
        $rows = query($sql);
        $work_phone = '';
        foreach ($rows as $row) {
            if (strlen($work_phone) > 0) {
                $work_phone .= '; ';
            }
            $work_phone .= my_decrypt($row["encrypted_text"]);
        }
        $sql = "select encrypted_text from sensitive_text st, sensitive_text_type stt where st.people_id = $people_id ";
        $sql .= " and stt.text_description = 'Email - Home' ";
        $sql .= " and st.text_type = stt.id";
        $rows = query($sql);
        $home_email = '';
        foreach ($rows as $row) {
             if (strlen($home_email) > 0) {
                $home_email .= '; ';
            }
            $home_email .= my_decrypt($row["encrypted_text"]);
        }
        $sql = "select encrypted_text from sensitive_text st, sensitive_text_type stt where st.people_id = $people_id ";
        $sql .= " and stt.text_description = 'Email - Work' ";
        $sql .= " and st.text_type = stt.id";
        $rows = query($sql);
        $work_email = '';
        foreach ($rows as $row) {
             if (strlen($work_email) > 0) {
                $work_email .= '; ';
            }
            $work_email .= my_decrypt($row["encrypted_text"]);
        }
        $sql = "select encrypted_text from sensitive_text st, sensitive_text_type stt where st.people_id = $people_id ";
        $sql .= " and stt.text_description = 'ID No - ZA' ";
        $sql .= " and st.text_type = stt.id";
        $rows = query($sql);
        $id_za = '';
        foreach ($rows as $row) {
             if (strlen($id_za) > 0) {
                $id_za .= '; ';
            }
            $id_za .= my_decrypt($row["encrypted_text"]);
        }
        $sql = "select encrypted_text from sensitive_text st, sensitive_text_type stt where st.people_id = $people_id ";
        $sql .= " and stt.text_description = 'Birth Date (yyyy-mm-dd)' ";
        $sql .= " and st.text_type = stt.id";
        $rows = query($sql);
        $birth_date = '';
        foreach ($rows as $row) {
             if (strlen($birth_date) > 0) {
                $birth_date .= '; ';
            }
            $birth_date .= my_decrypt($row["encrypted_text"]);
        }
        $sql = "select encrypted_text from sensitive_text st, sensitive_text_type stt where st.people_id = $people_id ";
        $sql .= " and stt.text_description = 'Wedding Date (yyyy-mm-dd)' ";
        $sql .= " and st.text_type = stt.id";
        $rows = query($sql);
        $wedding_date = '';
        foreach ($rows as $row) {
             if (strlen($wedding_date) > 0) {
                $wedding_date .= '; ';
            }
            $wedding_date .= my_decrypt($row["encrypted_text"]);
        }
        $sql = "select asset_name from asset, people_asset where people_id = $people_id and asset_id = asset.id and asset_type = 1";
        $rows = query($sql);
        if (count($rows) > 0) {
            $cottage = $rows[0]["asset_name"];
        } else {
            $cottage = '';
        }
        $sql = "select group_name from `groups`, memberships where people_id = $people_id and group_id = groups.id";
        $rows = query($sql);
        $status = '';
        $filler = '';
        if (count($rows) > 0) {
            foreach ($rows as $row) {
                $status .= $filler . $row["group_name"];
                $filler = '; ';
            }
        } else {
            $status = '';
        }
    
        $trans = $surname . " - " . $first_name;
        if (strlen($given_name) > 1) {
            $trans .= " (" . $given_name . ")";
        }
        $trans = '"' . $full_name . '"' . "\t";
        //$trans .= "\t";
        $trans .= $surname . "\t";
        $trans .= $first_name . "\t";
        $trans .= $other_name . "\t";
        $trans .= $given_name . "\t";
        $trans .= $title . "\t";
        $trans .= $status . "\t";
        $trans .= $account_no . "\t";
        $trans .= $home_phone . "\t";
        $trans .= $mobile_phone . "\t";
        $trans .= $work_phone . "\t";
        $trans .= $home_email . "\t";
        $trans .= $work_email . "\t";
        $trans .= $cottage . "\t";
        $trans .= $id_za . "\t";
        $trans .= $birth_date . "\t";
        $trans .= $wedding_date . "\t";
        $trans .= "\n";
        fwrite($fp, $trans);
    }
    //echo '</ul>';
    fclose($fp);
    require "../inc/footer.php";
}
?>
