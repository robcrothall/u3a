<h2>Record sensitive data</h2>
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
    <input type='submit' value='Save' class='w3-button w3-green' />
    <a href='../page/popi_data.php' class='w3-button w3-green'>Back to list</a> Person selected: 
    <?php
        $rows = query("SELECT surname, first_name, other_names, given_name from people where ID = ?", $_SESSION["selected_people_id"]);
        $row = $rows[0];
        echo $row['surname'] . ", " . $row["first_name"] . " " . $row["other_names"];
        if (!empty($row["given_name"])) {
            echo " (" . $row["given_name"] . ")";
        }
            ?>
    <br>
    <table class='w3-table-all'>
        <tr>
            <td>Text type:</td>
            <td>
                <select name="text_type">
<?php
$sql = "SELECT id, text_description from sensitive_text_type order by text_description";
$rows = query($sql);
foreach ($rows as $row) {
    if ($row['id'] == 2) {
        $selected = " selected";
    } else {
        $selected = "";
    }
    echo "<option value=" . $row["id"] . $selected . ">" . $row["text_description"] . "</option>";
}
?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Text value:</td>
            <td><input type="text" name="clear_text" class="form_control"></td>
        </tr>
    </table>
    <br>
    <input type='submit' value='Save' class='w3-button w3-green' />
    <a href='../page/popi_data.php' class='w3-button w3-green'>Back to list</a>
</form>
