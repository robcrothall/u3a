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
if (!empty($_SESSION["surname"])) {
    $surname = $_SESSION["surname"];
} else {
    $surname = "";
}
if (!empty($_SESSION["people_id"])) {
    $people_id = $_SESSION["people_id"];
} else {
    $people_id = 0;
}
if (!empty($_SESSION["first_name"])) {
    $first_name = $_SESSION["first_name"];
} else {
    $first_name = "";
}
if (!empty($_SESSION["other_name"])) {
    $other_name = $_SESSION["other_name"];
} else {
    $other_name = "";
}
if (!empty($_SESSION["given_name"])) {
    $given_name = $_SESSION["given_name"];
} else {
    $given_name = "";
}
/*
if (!empty($_SESSION["title_id"])) {
    $title_id = $_SESSION["title_id"];
} else {
    $title_id = 0;
} */
if (!empty($_SESSION["sex_id"])) {
    $sex_id = $_SESSION["sex_id"];
} else {
    $sex_id = 0;
}
if (!empty($_SESSION["race_id"])) {
    $race_id = $_SESSION["race_id"];
} else {
    $race_id = 0;
}
/*
if (!empty($_SESSION["new_title"])) {
    $new_title = $_SESSION["new_title"];
} else {
    $new_title = "";
} */
if (!empty($_SESSION["account_no"])) {
    $account_no = $_SESSION["account_no"];
} else {
    $account_no = "";
}
if (!empty($_SESSION["checked"])) {
    $checked = $_SESSION["checked"];
} else {
    $checked = "N";
}
?>
<form action="../page/people_create.php" method="post">
    <input type='submit' value='Save' class='w3-button w3-green' />
    <a href='../page/people.php' class='w3-button w3-green'>Back to People</a>&nbsp;
    <?php
    if ($_SESSION["new_person"] > 0) {
        echo '<a class="w3-button w3-green" href="../page/people_read.php?id=' . $_SESSION["new_person"];
        echo '">More details</a>&nbsp;';
    }
    ?>
    <table class='w3-table-all'>
        <tr>
            <td>Surname</td>
            <td><input type='text' name='surname' value="<?php echo $surname; ?>" 
            maxlength="50" size="50" required autofocus></td>
        </tr>
        <tr>
            <td>First name</td>
            <td><input type='text' name='first_name' value="<?php echo $first_name; ?>"
            maxlength="50" size="50" required></td>
        </tr> 
        <tr>
            <td>Other names</td>
            <td><input type='text' name='other_name' value="<?php echo $other_name; ?>"
            maxlength="50" size="50"></td>
        </tr> 
        <tr>
            <td>Given name</td>
            <td><input type='text' name='given_name' value="<?php echo $given_name; ?>"
            maxlength="50" size="50"></td>
        </tr> 
        <tr>
            <td>Title</td>
            <td>
<?php
$sql = 'select id, title from title ';
$sql .= 'where title not like "% and %" ';
$sql .= 'order by title';
$rows = query($sql);
foreach ($rows as $r) {
    echo '<input type="checkbox" id="' . $r["id"] . '" name="' . "title[]" 
        . '" value="' . $r["id"] . '"';
    echo '>&nbsp;<label for="' . $r["id"] . '">' . $r["title"] . '</label>&emsp;&emsp;' . "\r\n";
}
?>
            </td>
        </tr> 
        <tr>
            <td>Occupation</td>
            <td>
<?php
$sql = 'select id, occupation from occupation ';
$sql .= 'order by occupation';
$rows = query($sql);
foreach ($rows as $r) {
    echo '<input type="checkbox" id="' . $r["id"] . '" name="' . "occupation[]"
        . '" value="' . $r["id"] . '"';
    echo '>&nbsp;<label for="' . $r["id"] . '">' . $r["occupation"] . '</label>&emsp;&emsp;' . "\r\n";
}
?>
            </td>
        </tr>
        <tr>
            <td>Company</td>
            <td>
<?php
$sql = 'select id, co_name from company ';
$sql .= 'order by co_name';
$rows = query($sql);
foreach ($rows as $r) {
    echo '<input type="checkbox" id="' . $r["id"] . '" name="' . "company[]"
        . '" value="' . $r["id"] . '"';
    echo '>&nbsp;<label for="' . $r["id"] . '">' . $r["co_name"] . '</label>&emsp;&emsp;' . "\r\n";
}
?>
            </td>
        </tr>
        <tr>
            <td>Account No (if it already exists)</td>
            <td><input type='text' name='account_no' value="<?php echo $account_no; ?>"
                maxlength="10" size="10"></td>
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
