<?php
/**
 * People_read_form
 * 
 * This page displays details about a person.
 * PHP Version 7.1
 * 
 * @category WebPage
 * @package  Sample
 * @author   "Rob Crothall" <rob@crothall.co.za>
 * @license  GPL 1.0 or later
 * @version  GIT: <git-id>
 * @link     http://www.sprv.co.za
 */
$_SESSION["module"] = $_SERVER["PHP_SELF"];
$people_id = htmlspecialchars(strip_tags($form_id));
$data = query(
    "select a.surname, a.first_name, a.other_name, a.given_name, " .  
    "a.account_no, " . 
    "a.checked, a.user_id, a.changed from people a where a.id = ?", 
    $people_id
); 
$_SESSION["selected_people_id"] = $people_id;
$_SESSION["search_name_start"]  = $data[0]["surname"];
//$_SESSION["selected_cottage"]   = $data[0]["cottage"];
$surname        = $data[0]["surname"];
$first_name     = $data[0]["first_name"];
$other_name     = $data[0]["other_name"];
$given_name     = $data[0]["given_name"];
$account_no     = $data[0]["account_no"];
$checked        = $data[0]["checked"];
$user_id        = $data[0]["user_id"];
$changed        = $data[0]["changed"];
$full_name      = $surname . ", " . $first_name;
if (!empty($other_name)) {
    $full_name .= " " . $other_name;
}
if (!empty($given_name)) {
    $full_name .= " (" . $given_name . ")";
}
$sql = "select a.title_id, b.title from people_title a, title b ";
$sql .= "where a.people_id = ? and a.title_id = b.id";
$data = query($sql, $people_id);
$title = "";
$filler = "";
if (count($data) > 0) {
    foreach ($data as $row) {
        $title .= $filler . $row["title"];
        $filler = " ";
    }
} else {
    $title = "";
}
$sql = "select b.occupation from people_occupation a, occupation b where a.people_id = ? and a.occupation_id = b.id";
$data = query($sql, $people_id);
$occupation = "";
$filler = "";
if (count($data) > 0) {
    foreach ($data as $row) {
        $occupation .= $filler . $row["occupation"];
        $filler = ", ";
    }
} else {
    $occupation = "";
}
$sql = "select b.co_name from people_company a, company b where a.people_id = ? and a.company_id = b.id";
$data = query($sql, $people_id);
$co_name = "";
$filler = "";
if (count($data) > 0) {
    foreach ($data as $row) {
        $co_name .= $filler . $row["co_name"];
        $filler = ", ";
    }
} else {
    $co_name = "";
}
$staff = check_role("STAFF");
$pr = check_role("PR");
$sql = "select asset_name, asset_size, billable ";
$sql .= "from asset a, people_asset b ";
$sql .= "where a.id = b.asset_id ";
$sql .= "and b.people_id = ?";
$data = query($sql, $people_id);
$spacer = "";
$asset_name = "";
if (count($data) > 0) {
    foreach($data as $row) {
        $asset_name .= $spacer;
        if ($staff) {
            $asset_name .= $row["asset_name"] . " (" . $row["asset_size"];
            $asset_name .= " square metres";
            if ($row["billable"]) {
                $asset_name .= ", billable";
            }
            $asset_name .= ")";
        } else { 
            $asset_name .= $row["asset_name"];
        }
        $spacer = "<br>"; 
    }
}
$data = query("select * from users where id = ?", $user_id);
$username = $data[0]["username"];
$sql = "select surname, first_name, given_name ";
$sql .= "from people ";
$sql .= "where id = ?";
$rows = query($sql, $data[0]["people_id"]);
$user_full_name = $rows[0]["surname"] . ", " . $rows[0]["first_name"];
if (strlen($rows[0]["given_name"]) > 0) {
    $user_full_name .= " (" . $rows[0]["given_name"] . ")";
}
?>
<h2>Read about a Person</h2>
    <a class="w3-button w3-green" href="../page/people.php">Back</a>&nbsp;
<?php
if (check_role("CC")) {
    echo '<a class="w3-button w3-green" ';
    echo 'href="../page/medhist.php">Medical History</a>&nbsp;';
}
if (check_role("HR") or check_role("S_Staff")) {
    echo '<a class="w3-button w3-green" ';
    echo 'href="../page/popi_data.php">Sensitive Data</a>&nbsp;';
}
if (check_role("STAFF") or check_role("S_Staff")) {
    echo '<a class="w3-button w3-green" ';
    echo 'href="../page/people_vehicle.php">Linked Vehicles</a>&nbsp;';
}
if (check_role("STAFF") or check_role("S_Staff")) {
    echo '<a class="w3-button w3-green" ';
    echo 'href="../page/people_docs.php">Linked documents</a>&nbsp;';
}
echo '<table class="w3-table-all">';
if ($staff) {
    echo '<tr>';
    echo '<td>Record ID:</td>';
    echo '<td>' . $people_id . '</td>';
    echo '</tr>';
}
?>
    <tr>
    <td>Person name:</td>
    <td><?php echo $full_name; ?></td>
    </tr>
    <tr>
    <td>Title:</td>
    <td><?php echo $title; ?></td>
    </tr>
<?php
if ($staff) {
    echo '<tr>';
    echo '<td>Account number:</td>';
    echo '<td>' . $account_no . '</td>';
    echo '</tr>';
}
echo '<tr>';
echo '<td>Company:</td>';
echo '<td>' . $co_name . '</td>';
echo '</tr>';
if (strlen($asset_name) > 0) {
    echo '<tr>';
    echo '<td>Asset(s):</td>';
    echo '<td>' . $asset_name . '</td>';
    echo '</tr>';
}
// Print sensitive text
$sql = "select a.encrypted_text, b.text_description, b.table_name, b.data_type ";
$sql .= "from sensitive_text a, sensitive_text_type b ";
$sql .= "where a.text_type = b.id ";
$sql .= "and a.disclose = 'Y' ";
//if (!$staff) {
//    $sql .= "or b.data_type in ('phone', 'email') ";
//}
$sql .= "and a.people_id = ? ";
$sql .= "order by b.data_type, b.text_description ";
$data = query($sql, $people_id);
$spacer = "";
$asset_name = "";
if (count($data) > 0) {
    foreach($data as $row) {
        echo '<tr>';
        echo '<td>' . $row["text_description"] . ':</td>';
        $value = my_decrypt($row["encrypted_text"]);
        if ($row["data_type"] == "index") {
            // This hack is because data takeon used M/F and data is encrypted.
            if (!is_numeric($value)) {
                if ($value == "M") {$value = 1;}
                elseif ($value == "F") {$value = 2;}
                else {$value = 0;}
            }
            //$table_name = strtolower($row["text_description"]);
            //var_dump($row, $value);
            $table_name = strtolower($row["table_name"]);
            if ($table_name == "sex" or $table_name == "race" or $table_name == "yes_no") {
                $column_name = "value";
            } elseif ($table_name == "asset") {
                $column_name = "asset_name";
            }
            $sql = "select " . $column_name . " from " . $table_name . " where id = " . $value;
            //echo "$sql<br>";
            $val = query($sql);
            $value = $val[0][$column_name];
        }
        //echo '<td>' . $value . '</td>';
        echo '<td align="left">' . $value . '</td>';
        echo '</tr>';
        }
}
if ($staff) {
    echo '<tr>';
    echo '<td>Occupation:</td>';
    echo '<td>' . $occupation . '</td>';
    echo '</tr>';
    echo "<tr>";
    echo '<td>Checked status:</td>';
    echo '<td>' . $checked . '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>Changed by:</td>';
    echo '<td>' . $username . ' - ';
    echo $user_full_name . '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>Changed on:</td>';
    echo '<td>' . $changed . '</td>';
    echo '</tr>';
}
?>
    </table> 
<?php
if ($staff) {
    echo '<h2>Relationships</h2>';
    //echo '<a href="../page/people_related_create.php" 
    //class="w3-button w3-green">Maintain relationships</a>&nbsp;';
    echo '<a href="../page/people_related.php" ';
    echo 'class="w3-button w3-green">Maintain relationships</a>&nbsp;' . "\n";
    //echo '<table class="w3-table-all" border="0" cellpadding="0" cellspacing="10" ';
    echo '<table class="w3-table-all"';
    //echo 'width="100%">' . "\n";
    echo '>' . "\n";
    echo '<thead>' . "\n";
    echo '<tr>';
    echo '<th>Date</th>';
    echo '<th>Relationship</th>';
    echo '<th>Person</th>';
    echo '<th>Notes</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    $rsql  = "SELECT a.id, a.related_id, a.relationship, a.relationship_date, r.primary_desc as descr, ";
    $rsql .= "a.notes, b.surname, b.first_name, b.given_name, 'Primary' as source ";
    $rsql .= " from people_related a, people b, relationships r ";
    $rsql .= " where a.people_id = ? and a.related_id = b.id and a.relationship_id = r.id ";
    $rsql .= " UNION ";
    $rsql .= " SELECT c.id, c.people_id, c.relationship, c.relationship_date, s.secondary_desc as descr, ";
    $rsql .= " c.notes, d.surname, d.first_name, d.given_name, ";
    $rsql .= " 'Secondary' as source "; 
    $rsql .= " from people_related c, people d, relationships s ";
    $rsql .= " where c.related_id = ? and c.people_id = d.id and c.relationship_id = s.id "; 
    $rsql .= " order by relationship, surname ";
    //var_dump(__LINE__, $rsql);
    $rows = query($rsql, $people_id, $people_id);
    if (count($rows) > 0) {
        foreach ($rows as $row) {
            echo '<tr>';
            //echo '<td valign="top" style="width:100px">';
            echo '<td>';
            echo $row['relationship_date'] . '</td>';
            echo '<td>' . $row['descr'] . '</td>';
            $r_url = '<a href="../page/people_read.php?id=';
            $r_url .= $row['related_id'] . '">' . $row['surname'] . ', ';
            $r_url .= $row['first_name'] . '</a>';
            //echo '<td valign="top">' . $r_url . '</td>';
            echo '<td>' . $r_url . '</td>';
            //echo '<td valign="top">' . $row["source"] . ': ' . $row["notes"];
            echo '<td>' . $row["source"] . ': ' . $row["notes"];
            echo '</td>';
            echo '</tr>';
        }
    } else {
        echo "<tr><td></td><td>There are no relationships associated ";
        echo "with this person.</td>";
    }
    echo '</tbody>';
    echo '</table>';
    // -----------------------------------------------------------
    echo '<h2>Memberships</h2>';
    echo '<a href="../page/memberships_add.php" ';
    echo 'class="w3-button w3-green">Add Memberships</a>&nbsp;' . "\n";
    //echo '<table class="w3-table-all" border="0" cellpadding="0" cellspacing="10" ';
    //echo 'width="100%">' . "\n";
    echo '<table class="w3-table-all"';
    echo '>' . "\n";
    echo '<thead>' . "\n";
    echo '<tr>';
    echo '<th>Date joined</th>';
    echo '<th>Group</th>';
    echo '<th>Is Leader</th>';
    echo '<th>Expires</th>';
    //echo '<th>Status</th>';
    echo '<th>Action</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    $rsql  = "SELECT a.id, a.join_date, a.expiry_date, a.status, a.is_manager, ";
    $rsql .= "b.group_name, b.fee_reqd, b.start_month, b.duration_in_months ";
    $rsql .= " from memberships a, `groups` b ";
    $rsql .= " where a.people_id = ? and a.group_id = b.id ";
    $rsql .= " order by group_name ";
    $rows = query($rsql, $people_id);
    if (count($rows) > 0) {
        foreach ($rows as $row) {
            if ($row["expiry_date"] < date("Y-m-d")) {
                $expires =  $row["expiry_date"] . " - expired";
            } else {
                $expires = $row["expiry_date"];
            }
            //if ($row["fee_reqd"] == "N") {
            //    $expires = "N/A";
            //}
            echo '<tr>';
            //echo '<td valign="top" style="width:100px">';
            echo '<td>';
            echo $row['join_date'] . '</td>';
            echo '<td>' . $row['group_name'] . '</td>';
            echo '<td valign="top">' . $row["is_manager"] . '</td>';
            echo '<td valign="top">' . $expires;
            echo '</td>';
            //echo '<td valign="top" style="width:280px">';
            echo '<td>';
            //echo '<a class="w3-button w3-green" ';
            //echo 'href="../page/memberships_read.php?id=' . $row['id'];
            //echo '">Read</a>' . '&nbsp;';
            echo '<a class="w3-button w3-green" ';
            echo 'href="../page/memberships_edit.php?id=' . $row['id'];
            echo '">Update</a>' . '&nbsp;';
            if (check_role("STAFF")) {
                echo '<a class="w3-button w3-red" ';
                echo 'href="../page/memberships_delete.php?id=' . $row['id'];
                echo '">Delete</a>';
            }
            echo '</td>';
            echo '</tr>';
        }
    } else {
        echo "<tr><td></td><td>There are no memberships recorded ";
        echo "for this person.</td>";
    }
    echo '</tbody>';
    echo '</table>';
    // -----------------------------------------------------------
    echo '<h2>History</h2>';
    echo '<a href="../page/history.php" ';
    echo 'class="w3-button w3-green">Maintain personal history</a>&nbsp;';
    echo '<table class="w3-table-all"';
    echo '>';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Event date</th>';
    echo '<th>Event description</th>';
    echo "<th>Action</th>";
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    $sql = "SELECT id, event_date, notes from history ";
    $sql .= "where people_id = ? order by event_date desc, id desc";
    $rows = query($sql, $people_id);
    if (count($rows) > 0) {
        foreach ($rows as $row) {
            echo '<tr>';
            echo '<td>' . $row['event_date'];
            echo '</td>';
            echo '<td>' . $row['notes'] . '</td>';
            if ($staff) {
                echo '<td>';
                echo '<a class="w3-button w3-green" ';
                echo 'href="../page/history_read.php?id=' . $row['id'];
                echo '">Read</a>' . '&nbsp;';
                echo '<a class="w3-button w3-green" ';
                echo 'href="../page/history_update.php?id=' . $row['id'];
                echo '">Update</a>' . '&nbsp;';
                echo '<a class="w3-button w3-red" ';
                echo 'href="../page/history_delete.php?id=' . $row['id'];
                echo '">Delete</a>';
            }
            echo '</td>';
            echo '</tr>';
        }
    } else {
        echo "<tr><td></td><td>";
        echo "There are no events associated with this person.</td>";
    }
    echo '</tbody>';
    echo '</table>';
}
?>
   <div class="form-actions">
      <a class="w3-button w3-green" href="../page/people.php">Back to people</a>
   </div>
