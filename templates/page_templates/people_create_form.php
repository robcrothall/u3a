<h2>Record a new Person</h2>
<?php
/**
 * People_create_form
 * 
 * This displays the fields required for creating a person record
 * PHP Version 7.1
 * 
 * @category WebPage
 * @package  Sample
 * @author   "Rob Crothall" <rob@crothall.co.za>
 * @license  GPL 1.0 or later
 * @version  GIT: <git-id>
 * @link     http://www.sprv.co.za
 */
$people_id = 0;
$surname = "";
$first_name = "";
$other_names = "";
$given_name = "";
$title = "";
$title_id = 0;
$account_no = "";
$checked = "N";
?>
<form action="../page/people_create.php" method="post">
    <input type='submit' value='Save' class='w3-button w3-green' />
    <a href='../page/people.php' class='w3-button w3-green'>Back to People</a>
    <table class='w3-table-all' width="100%">
        <tr>
            <td align="right" valign="top">Surname</td>
            <td><input type='text' name='surname'  
            maxlength="50" size="50" required></td>
        </tr>
        <tr>
            <td align="right" valign="top">First name</td>
            <td><input type='text' name='first_name'  
            maxlength="50" size="50" required></td>
        </tr> 
        <tr>
            <td align="right" valign="top">Other names</td>
            <td><input type='text' name='other_names'  
            maxlength="50" size="50"></td>
        </tr> 
        <tr>
            <td align="right" valign="top">Given name</td>
            <td><input type='text' name='given_name'  
            maxlength="50" size="50"></td>
        </tr> 
        <tr>
            <td>Title</td>
            <td>
                <select name="title" required>
<?php
$sql = 'select id, title from title ';
$sql .= 'where title not like "% and %" ';
$sql .= 'order by title';
$title = query($sql);
echo '<option value=0>Please choose</option>';
foreach ($title as $t) {
    echo "<option value=" . $t["id"];
    echo ">" . $t["title"] . "</option>";
}
?>
                </select>
            </td>
        </tr> 
        <tr>
            <td align="right" valign="top">New Title, if not in the list</td>
            <td><input type='text' name='new_title' maxlength="20" size="20"></td>
        </tr> 
        <tr>
            <td>Account No (if it already exists)</td>
            <td><input type='text' name='account_no' maxlength="10" size="10"></td>
        </tr> 
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save' class='w3-button w3-green' />
                <a href='../page/people.php' 
                class='w3-button w3-green'>Back to People</a>
            </td>
        </tr>
    </table>
</form>
