<?php
/**
 * Program: roles_edit
 * 
 * Edit roles for a user.
 * php version 5
 * 
 * @category WebPage
 * @package  Sample
 * @author   "Rob Crothall" <rob@crothall.co.za>
 * @license  GPL 1.0 or later
 * @version  GIT: <git_id>
 * @link     http://www.sprv.co.za
 */

    $_SESSION["module"] = $_SERVER["PHP_SELF"];
    $my_id = test_input($_SESSION["rec_id"]);
    $_SESSION["user_id"] = $my_id;
    $sql = "select a.username, b.surname, b.first_name ";
    $sql .= "from users a, people b ";
    $sql .= "where a.id = ? and a.people_id = b.id";
    $data = query($sql, $my_id); 
    $username        = $data[0]["username"];
    $surname         = $data[0]["surname"];
    $first_name      = $data[0]["first_name"];
?>
<h2>Edit Roles for <?php echo $surname . ", " . $first_name ?></h2>
<form action="../page/roles_edit.php" method="post">
    <input type='submit' value='Save' class='w3-button w3-green' />
    <a href='../page/roles.php' class='w3-button w3-green'>Back to Roles</a><br>
    <p>Select a role to grant that role and to extend the time 
        until the role expires.</p>
    <p>Remove the selection to remove the role immediately.</p>
    <?php
    $sql = "Select id, role_name, role_days from roles order by role_name";
    $roles = query($sql);
    foreach ($roles as $r) {
        $expiry = "";
        $sql = "select role_expiry from user_roles where user_id = ? ";
        $sql .= "and role_id = ?";
        $rows = query($sql, $my_id, $r["id"]);
        echo '<input type="checkbox" id="' . $r["id"] . '" name="' . $r["id"] 
            . '" value="' . $r["id"] . '"';
        if (!empty($rows[0]["role_expiry"])) {
            echo " checked";
            $expiry = " - expires on " 
                . date("Y-m-d", strtotime($rows[0]["role_expiry"]));
        }
        echo '>&emsp;<label for="' . $r["id"] . '">' . $r["role_name"] . $expiry
            . '</label><br>';
    }
    ?>
   <input type='submit' value='Save' class='w3-button w3-green' />
    <a href='../page/roles.php' class='w3-button w3-green'>Back to Roles</a><br>
</form>
