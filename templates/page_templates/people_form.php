<?php
/**
 * People_form
 * 
 * This stops non-staff from seeing draft policies and staff policies
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
?>
<h2 align="center">List of People</h2>
<form action="../page/people.php">
<?php
if (check_role("STAFF") or check_role("ADMIN")) {
    echo '<a href="../page/people_create.php" class="w3-button w3-green">';
    echo 'Create a new person</a>';
    echo '&nbsp;&nbsp;&nbsp;&nbsp;';
}
?>
<input type="submit" value="Surnames from:">
<input type="search" name="search_string" autofocus="true" 
    value="<?php echo $_SESSION["search_name_start"]; ?>">
</form>
<div class="row">
<table class="w3-table">
    <thead>
        <tr>
            <th>Person</th>
            <th>Cottage</th>
            <th>Roles</th>
            <th>Company</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
<?php 
//print_r(" Session = ");
//print_r($_SESSION["search_name_start"]);
//print_r(" Variable ");
//print_r($search_name_start);
$cmd1 = "SELECT a.id, a.surname, a.first_name, a.other_names, a.given_name, ";
$cmd1 .= "b.co_name "; 
$cmd1 .= "from people a, company b, people_company c ";
$cmd1 .= "where c.people_id = a.id ";
$cmd1 .= "and c.company_id = b.id ";
if (!check_role("STAFF")) {
    $cmd1 .= " and b.id in (1, 2) ";
}
$cmd2 = ' and surname >= "' . $_SESSION["search_name_start"] . '" ';
$cmd3 = " order by surname, first_name limit 50";
$cmd = $cmd1 . $cmd2 . $cmd3;
//print_r($cmd);
$rows = query($cmd);
if (count($rows) > 0) {
    foreach ($rows as $row) {
        echo '<tr>';
        echo '<td>' . $row['surname'];
        $_SESSION['search_name_start'] = $row['surname'];
        if (!empty($row['first_name'])) {
            echo ", " . $row['first_name'];
        }
        if (!empty($row['other_name'])) {
            echo " " . $row['other_name'];
        }
        if (!empty($row['given_name'])) {
            echo " (" . $row['given_name'] . ")";
        }
        echo '</td>';
        echo '<td>';
        $sql = "select a.asset_name from asset a, people_asset b ";
        $sql .= "where a.id = b.asset_id ";
        $sql .= "and b.people_id = ?";
        $assets = query($sql, $row["id"]);
        $comma = "";
        if (count($assets) > 0) {
            foreach ($assets as $a) {
                echo $comma . $a["asset_name"];
                $comma = ", ";
            }
        }
        echo '</td>';
        echo '<td>';
        $sql = "select 1 from memberships a, groups b ";
        $sql .= "where b.group_name = 'Deceased' ";
        $sql .= "and b.id = a.group_id ";
        $sql .= "and a.people_id = ?";
        $deceased = query($sql, $row["id"]);
        if (count($deceased)) {
            echo "Deceased";
        } else {
            $sql = "select group_name from groups a, memberships b ";
            $sql .= "where a.id = b.group_id ";
            $sql .= "and b.people_id = ?";
            $groups = query($sql, $row["id"]);
            $comma = "";
            if (count($groups) > 0) {
                foreach ($groups as $g) {
                    echo $comma . $g["group_name"];
                    $comma = ", ";
                }
            }
        }
        echo '</td>';
        echo '<td>' . $row['co_name'] . '</td>';
        echo '<td>';
        echo '<a class="w3-button w3-green" href="../page/people_read.php?id=';
        echo $row['id'] . '">Read</a>' . '&nbsp;';
        if (check_role("STAFF") or check_role("ADMIN")) {
            echo '<a class="w3-button w3-green" href="../page/people_update.php?id=';
            echo $row['id'] . '">Update</a>' . '&nbsp;';
            if (check_role("ADMIN")) {
                if ($row['id'] > 0) {
                    echo '<a class="w3-button w3-red" ';
                    echo 'href="../page/people_delete.php?id=' . $row['id'];
                    echo '">Delete</a>';
                }
            }
        }
        echo '</td>';
        echo '</tr>';
    }
}
?>
</tbody>
</table>
</div>
