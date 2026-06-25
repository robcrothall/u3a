<?php
    $_SESSION["module"]     = htmlspecialchars($_SERVER["PHP_SELF"]);
    $form_id                 = htmlspecialchars(strip_tags($form_id));
    $data = query("select * from sensitive_text where id = ?", $form_id); 
    $_SESSION["sensitive_text_id"] = $form_id;
    $people_id                 = $data[0]["people_id"]; 
    $text_type               = $data[0]["text_type"];
    $encrypted_text            = $data[0]["encrypted_text"];
    $user_id                = $data[0]["user_id"];
    $changed                 = $data[0]["changed"];
    $data = query("select text_description from sensitive_text_type where id = ?", $form_id);
    $text_description            = $data[0]["text_description"];
    $data = query("select username, people_id from users where id = ?", $user_id);
    $username                 = $data[0]["username"];
    $user_people_id         = $data[0]["people_id"];
    $sql = "select surname, first_name, other_names, given_name ";
    $sql .= "from people where id = ?";
    $data = query($sql, $user_people_id);
    $surname = $data[0]["surname"];
    $first_name = $data[0]["first_name"];
    $other_names = $data[0]["other_names"];
    $given_name = $data[0]["given_name"];
?>
<h2>This sensitive text is about to be deleted!</h2>
  <div class="container">
  <form action="../page/medhist_delete.php" method="post">
  <a class="w3-button w3-green" href="../page/medhist.php">Cancel</a>
   <table class="w3-table-all" border="0" cellpadding="0" cellspacing="10" width="100%">
          <tr>
                <td align="right" width="30%">Procedure date:</td>
                <td width="2%"></td>
                <td align="left" width="70%"><?php echo $proc_date; ?></td>
          </tr>
          <tr>
                <td align="right" width="30%">Procedure:</td>
                <td width="2%"></td>
                <td align="left" width="70%"><?php echo $description; ?></td>
          </tr>
          <tr>
                <td align="right" width="25%">Value:</td>
                <td width="2%"></td>
                <td align="left" width="70%"><?php echo $value; ?></td>
          </tr>
          <tr>
                <td align="right" width="25%">Price:</td>
                <td width="2%"></td>
                <td align="left" width="70%"><?php echo $price; ?></td>
          </tr>
          <tr>
                <td align="right" width="25%">Comment:</td>
                <td width="2%"></td>
                <td align="left" width="70%"><?php echo $comment; ?></td>
          </tr>
          <tr>
                <td align="right" width="25%">Changed by:</td>
                <td width="2%"></td>
                <td align="left" width="70%"><?php echo $username; ?></td>
          </tr>
          <tr>
                <td align="right" width="25%">Changed on:</td>
                <td width="2%"></td>
                <td align="left" width="70%"><?php echo $changed; ?></td>
          </tr>
    </table> 

   <div class="form-actions">
       <input type='submit' value='Delete' class='w3-button w3-red' />
      <a class="w3-button w3-green" href="../page/medhist.php">Cancel</a>
   </div>
  </div>
</form>
