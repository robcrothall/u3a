<?php
/**
 * Program: news_story.php
 * 
 * Display details about a news story.
 * PHP version 5
 * 
 * @category WebPage
 * @package  Sample
 * @author   "Rob Crothall" <rob@crothall.co.za>
 * @license  GPL 1.0 or later
 * @version  GIT: <git_id> 
 * @link     http://www.sprv.co.za
 * @PHP      7.1
 */
require "../inc/config.php"; 
$_SESSION["module"] = $_SERVER["PHP_SELF"];
require "../inc/head.php";
require "../inc/body.php";
require "../inc/menu.php";
require "../inc/msg.php";
echo '<h1>News item</h1>';
if ((!isset($_GET['id'])) || (trim($_GET['id'] == ''))) {
    $message = 'Missing record ID - please inform SysAdmin.';
}
$req_id = test_input($_GET['id']);
require "../inc/db_open.php";
$sql = "select a.title, a.content, a.effective_date, b.surname, b.first_name, ";
$sql .= "b.given_name from news a, people b where a.contact_id = b.id and a.id = ";
$sql .= $req_id;
$sql = "select a.title, a.content, a.effective_date, a.contact_id ";
$sql .= "from news a where a.id = ";
$sql .= $req_id;
$result = mysqli_query($handle, $sql) 
    or die("Error in query: $sql. " . mysqli_error($handle));
$row = $result->fetch_array();
//echo '<br>Type of row: ' . gettype($row) . '<br>';
if (gettype($row) == NULL) {
    die("No result returned for contact from database - please advise SysAdmin.");
}
echo '<h2>' . $row["title"] . '</h2>';
echo '<font size="-1">' . formatDate($row["effective_date"]) . '</font><p>';
echo '<p>' . $row["content"] . '</p>';
echo '<p>This press release was published on ';
echo formatDate($row["effective_date"]);
echo '. For more information, please contact your R&S Representative';
/* read the contact person from the database */
$sql = "select surname, first_name, given_name from people where id = ";
$sql .= $row["contact_id"];
$result = mysqli_query($handle, $sql)
    or die("Error in query: $sql. " . mysqli_error($handle));
$row = $result->fetch_array();
if (count($row) == 0) {
    die("No result returned for contact from database - please advise SysAdmin.");
}
if (trim($row["given_name"] == '')) {
    echo ' or ' . $row["first_name"];
} else {
    echo ' or ' . $row["given_name"];
}
echo " " .  $row["surname"] . "."; 
mysqli_free_result($result);
$sql = "insert ignore into news_users (news_id, user_id) values (";
$sql .= $req_id .", " . $_SESSION["id"] . ")";
$result = mysqli_query($handle, $sql); 
echo '<br><br><a class="w3-button w3-green" ';
echo 'href="../page/news_list.php">Back to News List</a>';
echo "&nbsp;";
echo "This item will be removed from your news list.";
require "../inc/msg.php";
require "../inc/footer.php";
?>
