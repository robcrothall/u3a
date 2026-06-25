<?php
/**
 * Program: popi_data_form
 * 
 * List sensitive data.
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
?>
<h2>List of sensitive data</h2>
<!--  <div class="container"> -->
    <p>
      <a class="w3-button w3-green" 
      href="../page/people_read.php?id=<?php 
        echo $_SESSION["selected_people_id"] ?>">Back</a> &nbsp;
      <a href="../page/popi_data_add.php" 
      class="w3-button w3-green">Add sensitive data</a>
    </p>
    <div class="row">
      <table class="w3-table-all">
        <tbody>
          <tr>
            <td width="30%">Sensitive data associated with:</td>
            <td width="70%"><b>
<?php
$sql = "SELECT surname, first_name, other_names, given_name ";
$sql .= "FROM `people` where id = ?";
$rows = query($sql, $_SESSION["selected_people_id"]);
$row = $rows[0];
echo $row['surname'] . ", " . $row["first_name"] . " " . $row["other_names"];
if (!empty($row["given_name"])) {
    echo " (" . $row["given_name"] . ")";
}
echo "</b>";
?>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="row">
      <table class="w3-table-all">
        <thead>
          <tr>
            <th>Data item</th>
            <th>Data value</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
<?php
$sql = "SELECT a.id, a.people_id, a.text_type, b.text_description, a.encrypted_text "; 
$sql .= "from sensitive_text a, sensitive_text_type b ";
$sql .= "where a.people_id = ? and a.text_type = b.id order by a.text_type";
$rows = query($sql, $_SESSION["selected_people_id"]);
if (count($rows) > 0) {
    foreach ($rows as $row) {
        $value = "";
        echo '<tr>';
        echo '<td>' . $row['text_description'] . '</td>';
        $value = my_decrypt($row["encrypted_text"]);
        echo '<td>' . $value . '</td>';
        echo '<td valign="top" style="width:280px">';
        echo '<a class="w3-button w3-green" href="../page/popi_data_update.php?id=';
        echo $row['id'] . '">Update</a> &nbsp;'; 
        echo '<a class="w3-button w3-red" href="../page/popi_data_delete.php?id=';
        echo $row['id'] . '">Delete</a>';
        echo '</td>';
        echo '</tr>';
    }
}
?>
                </tbody>
            </table>
        </div>
    <p>
      <a class="w3-button w3-green" href="../page/popi_data.php">Back</a> &nbsp;
      <a href="../page/popi_data_add.php" 
      class="w3-button w3-green">Add sensitive data</a>
    </p>
    </div>
