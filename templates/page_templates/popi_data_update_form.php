<?php

    $_SESSION["module"] = htmlspecialchars($_SERVER["PHP_SELF"]);
    $popi_data_id       = test_input($_SESSION["rec_id"]);
    $data = query("select * from sensitive_text where id = ?", $popi_data_id); 
    $people_id          = $data[0]["people_id"]; 
    $text_type          = $data[0]["text_type"];
    $encrypted_text     = $data[0]["encrypted_text"];
    $user_id            = $data[0]["user_id"];
    $changed            = $data[0]["changed"];
    $data = query("select people_id from users where id = ?", $user_id);
    $sql = "select surname, first_name, other_names, given_name, account_no ";
    $sql .= "from people where id = ?";
    $data = query($sql, $people_id);
    $surname            = $data[0]["surname"];
    $first_name         = $data[0]["first_name"];
    $other_names        = $data[0]["other_names"];
    $given_name         = $data[0]["given_name"];
    $account_no         = $data[0]["account_no"];
?>
<h2>Update sensitive data</h2>
    <input type='submit' value='Save' class='w3-button w3-green' />
    <a href='popi_data.php' class='w3-button w3-green'>Back to sensitive data</a>
Person:  
<?php 
echo $surname . ", " . $first_name . " " . $other_names; 
if (!empty($data[0]["given_name"])) {
    echo " (" . $data[0]["given_name"] . ") ";
}
?> 
Account No: <?php echo $account_no; ?>
<br>
<form action="../page/popi_data_update.php" method="post">
    <table class='w3-table-all'>
        <tr>
            <td>Procedure date</td> 
            <input type="hidden" id="rec_id" name="rec_id" value="<?php echo $history_id; ?>" /></td>
            <td><input type='date' name='proc_date' class='form-control' value='<?php echo $proc_date; ?>' /></td>
        </tr>
        <tr>
            <td>Procedure</td>
            <td>
              <select name="proc_id">
                  <?php
                      $rows = query("SELECT id, description FROM med_procedures order by description");
                      foreach ($rows as $row) {
                          if ($med_proc_id == $row['id'])
                              {$selected = " selected";}
                          else {$selected = "";}
                        echo "<option value=" . $row['id'] . $selected . ">" . $row["description"] . "</option>";
                    }
                  ?>
              </select>
            </td>
        </tr>
        <tr>
            <td>Value</td>
            <td><input type="text" name="value" class='form-control' value="<?php echo $value; ?>" /></td>
        </tr>
        <tr>
            <td>Price</td>
            <td><input type="text" name="price" class="form-control" value="<?php echo $price; ?>" /></td>
        </tr>
        <tr>
            <td>Comment</td>
            <td><input type="text" name="comment" class='form-control' value="<?php echo $comment; ?>" /></td>
        </tr>
    </table>
    <input type='submit' value='Save' class='w3-button w3-green' />
    <a href='medhist.php' class='w3-button w3-green'>Back to medical history</a>
</form>
