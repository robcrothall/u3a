<?php
/**    
 * Short description for file
 *
 * Long description for file (if any)...
 *
 * PHP version 5
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category   CategoryName
 * @package    PackageName
 * @author     Original Author <author@example.com>
 * @author     Another Author <another@example.com>
 * @copyright  1997-2005 The PHP Group
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    SVN: $Id$
 * @link       http://pear.php.net/package/PackageName
 * @see        NetOther, Net_Sample::Net_Sample()
 * @since      File available since Release 1.2.0
 * @deprecated File deprecated in Release 2.0.0
 */

$_SESSION["module"] = $_SERVER["PHP_SELF"];
$people_id = $_SESSION["rec_id"];
$_SESSION["people_id"] = $people_id;
$data = query("select * from people where id = ?", $people_id); 
$_SESSION["search_name_start"] = $data[0]["surname"];
//$_SESSION["selected_cottage"]  = $data[0]["cottage"];
$surname         = $data[0]["surname"];
$first_name      = $data[0]["first_name"];
$other_names     = $data[0]["other_names"];
$given_name      = $data[0]["given_name"];
if ($surname    == strtoupper($surname) | $surname == strtolower($surname)) {
    $surname    = ucwords(strtolower($surname));
}
if ($first_name == strtoupper($first_name)
    or $first_name == strtolower($first_name)
) {
    $first_name = ucwords(strtolower($first_name));
}
if ($other_names == strtoupper($other_names) 
    or $other_names == strtolower($other_names)
) {
    $other_names = ucwords(strtolower($other_names));
}
if ($given_name == strtoupper($given_name) 
    or $given_name == strtolower($given_name)
) {
    $given_name = ucwords(strtolower($given_name));
}
$title           = ucwords(strtolower($data[0]["title"]));
$account_no      = strtoupper($data[0]["account_no"]);
$sex             = $data[0]["sex"];
$race            = $data[0]["race"];
$checked         = $data[0]["checked"];
$user_id         = $data[0]["user_id"];
$changed         = $data[0]["changed"];
$data = query("select username from users where id = ?", $user_id);
$username        = $data[0]["username"];
?>
<br>
<h2>Update Person details</h2>

<form action="../page/people_update.php" method="post">
<input type='submit' value='Save' class='w3-button w3-green' />
<a href='people.php' class='w3-button w3-green'>Back to people</a>
    <table class='w3-table-all'>
        <tr>
            <td>Surname</td> 
            <input type="hidden" id="rec_id" name="rec_id" 
                value="<?php echo $people_id; ?>" /></td>
            <td><input type='text' name='surname' class='form-control' 
                required value="<?php echo $surname; ?>" /></td>
        </tr>
        <tr>
        <td>First name</td>
            <td><input type='text' name="first_name" class='form-control' 
                required value="<?php echo $first_name; ?>" /></td>
        </tr> 
        <tr>
        <td>Other names</td>
            <td><input type='text' name='other_names' class='form-control' 
                value="<?php echo $other_names; ?>" /></td>
        </tr> 
        <tr>
        <td>Given name</td>
            <td><input type='text' name='given_name' class='form-control' 
                value="<?php echo $given_name; ?>" /></td>
        </tr> 
        <tr>
        <td>Title - needs to be a dropdown</td>
            <td><input type='text' name='title' class='form-control' 
                value="<?php echo $title; ?>" /></td>
        </tr> 
        <tr>
        <td>Account No</td>
            <td><?php echo $account_no; ?></td>
        </tr> 
        <tr>
        <td>Sex</td>
            <td>
  <select name="sex">
  <?php
    $sex_status = ["U","F","M"];
    foreach ($sex_status as $status) {
        if ($sex == $status) {
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
        <td>Race</td>
            <td>
  <select name="race">
  <?php
    $race_status = ["Not specified","White","Black","Indian","Asian","Coloured"];
    foreach ($race_status as $status) {
        if ($race == $status) {
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
            <td></td>
            <td>
                <input type='submit' value='Save' class='w3-button w3-green' />
                <a href='people.php' class='w3-button w3-green'>Back to people</a>
            </td>
        </tr>
    </table>
</form>
