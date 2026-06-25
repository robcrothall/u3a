<?php
/**
 * Program: proj_list
 * 
 * Display details about projects.
 * php version 7.2.10
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
echo '<h1>List of projects</h1>';
if (check_role("STAFF")) {
    echo '<a href="proj_add.php" class="w3-button w3-green">';
    echo 'Add a Project</a>';
}
?>
<table class="w3-table-all">
  <thead>
    <tr>
      <th>Project name</th>
      <th>Project Manager</th>
      <th>Start</th>
      <th>End</th>
      <th>Status</th>
      <?php
      if (check_role("STAFF")) {
          echo "<th>Action</th>";
      }
      ?>
    </tr>
  </thead>
  <tbody>
<?php
$sql = "select a.id, a.proj_name, b.surname, b.first_name, b.given_name, a.proj_start, a.proj_end, a.proj_status ";
$sql .= "from projects a, people b ";
$sql .= "where a.proj_manager = b.id ";
$sql .= "order by a.proj_name";
foreach ($handle->query($sql) as $row) {
    echo '<tr>';
    echo '  <td>' . $row['proj_name'] . '</td>';
    $proj_mgr_name = "uninitialised";
    if (empty($row["surname"])) {
        $proj_mgr_name = "Unknown";
    } else {
        $proj_mgr_name = $row['surname'] . ", " . $row["first_name"];
        if (!empty($row["given_name"])) {
            $proj_mgr_name .= " (" . $row['given_name'] . ")";
        }
    }
    echo '  <td>' . $proj_mgr_name . '</td>';
    echo '  <td>' . $row['proj_start'] . '</td>';
    echo '  <td>' . $row['proj_end'] . '</td>';
    echo '  <td>';
    if (!isset($row["proj_status"])) {
        echo "Unknown";
    } else {
        if ($row["proj_status"]) {
            echo "Open";
        } else {
            echo "Closed";
        }
    }
    echo '</td>';
    if (check_role("STAFF")) {
        echo '<td>';
        echo '<a class="w3-button w3-green" href="../page/proj_edit.php?id=';
        echo $row['id'] . '">Update</a>';
        echo '<a class="w3-button w3-red" href="../page/proj_delete.php?id=';
        echo $row['id'] . '">Delete</a>';
        echo '  </td>';
    }
echo '</tr>';
}
?>
  </tbody>
</table>
<?php
require "../inc/msg.php";
require "../inc/footer.php";
?>
