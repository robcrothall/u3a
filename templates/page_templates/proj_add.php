
<?php
/**
 * Program proj_add
 * 
 * Maintain the Projects table
 * 
 * PHP version 7.1
 * 
 * @category Template
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
if ($_SERVER["REQUEST_METHOD"] <> "POST") {
    include "../inc/db_open.php";
    ?>
<h1>Add a project</h1>
<table cellspacing="5" cellpadding="5">
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
<tr>
    <td valign="top"><b>Project</b></td>
    <td><input size="80" maxlength="80" type="text" 
        name="proj_name" required autofocus></td>
</tr>
<tr>
    <td><b>Project Manager</b></td>
    <td>
        <select name="proj_manager">
    <?php
	$sql = "SELECT id, surname, first_name, given_name ";
	$sql .= "FROM people ";
	//$sql .= "'Staff', 'Contractor', 'Constant') ";
	$sql .= "order by surname, first_name";
	$rows = query($sql);
	foreach ($rows as $row) {
		/*if ($row["id"] == $proj_manager) {
			$selected = " selected";
		} else { */
		$selected = "";
		//}
		$name = $row["surname"];
		if (!empty($row["first_name"])) {
			$name .= ", " . $row["first_name"];
		}
		if (!empty($row["given_name"])) {
		   	$name .= " (" . $row["given_name"] . ")";
		}
		echo '<option value="' . $row["id"] . '"' . $selected . ">" . $name . "</option>\n";
	}
	?>
		</select>
    </td>
</tr>
<tr>
    <td><b>Start date</b></td>
    <td><input type="date" name="proj_start" required></td>
</tr>
<tr>
    <td><b>End date</b></td>
    <td><input type="date" name="proj_end" required></td>
</tr>
<tr>
    <td><b>Project status</b></td>
    <td>
        <select name="proj_status">
            <option value="1" selected>Open</option>
            <option value="0">Closed</option>
        </select>
    </td>
</tr>
<tr>
    <td colspan=2>
        <input type="submit" name="submit" value="Add" 
            class="w3-button w3-green"/>&nbsp;
        <a class="w3-button w3-green" href="../page/proj_list.php">
            Return to Project List</a>&nbsp;
    </td>

</tr>
</form>
</table>
    <?php
} else {
    include "../inc/msg.php";
    echo '<h1>Add a project</h1>';
    $errorList = array();
    $proj_name = test_input($_POST["proj_name"]);
    echo "<br>Project name: " . $proj_name;
    $proj_manager = test_input(($_POST["proj_manager"]));
    echo "<br>Project manager: " . $proj_manager;
    $proj_start = test_input($_POST["proj_start"]);
    echo "<br>Project start: " . $proj_start;
    $proj_end = test_input($_POST["proj_end"]);
    echo "<br>Project end: " . $proj_end;
    $proj_status = test_input($_POST["proj_status"]);
    echo "<br>Project status: " . $proj_status;
    $user_id = $_SESSION["id"];
    echo "<br>User ID: " . $user_id;
    if (trim($proj_name) == '') {
        $errorList[] = "Please enter a project name.";
    }
    include "../inc/db_open.php";
    $sql = 'select count(*) as kount from projects where proj_name = "';
    $sql .= $proj_name . '"';
    $result = mysqli_query($handle, $sql)
        or die("Error in query: $sql. " . mysqli_error($handle));
    foreach ($handle->query($sql) as $row) {
        if ($row["kount"] > 0) {
            $errorList[] = "A project with that name is already registered.";
        }
    }
    if (sizeof($errorList) == 0) {
        $sql = "insert into projects (proj_name, proj_manager, proj_start, proj_end, proj_status, ";
        $sql .= "user_id) values ('";
        $sql .= $proj_name . "', '" . $proj_manager . "', '" . $proj_start . "', '";
        $sql .= $proj_end . "', '" . $proj_status . "', " . $user_id . ")";
        $result = mysqli_query($handle, $sql) 
            or die("Error in query: $sql. " . mysqli_error($handle));
        echo "Project added successfully.<br><br>";
        // mysqli_free_result($result);
    } else { 
        echo 'The following errors were encountered:<br>';
        echo '<ul>';
        for ($x=0; $x<sizeof($errorList); $x++) {
            echo "<li>$errorList[$x]";
        }
        echo '</ul>';    
    }
    echo '<a class="w3-button w3-green" href="../page/proj_list.php">';
    echo 'Back to Project List</a>';
    include "../inc/msg.php";
    include "../inc/footer.php";
}
?>
