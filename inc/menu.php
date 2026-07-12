<!--<nav class="navbar navbar-expand-lg navbar-light bg-light px-3 mb-3"> -->
  <div class="container-fluid">
        <a class="navbar-brand" href="#">University of the Third Age - U3A (w1)</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
          <ul class="navbar-nav ms-auto">
        <!--    <li class="nav-item"><a class="nav-link active" aria-current="page" href="#home">Home</a></li> -->
<!--  <div class="navbar-nav"> -->
<?php
/**
 * Program: menu
 * 
 * Display relevant parts of main menu.
 * php version 5
 * 
 * @category WebPage
 * @package  Sample
 * @author   "Rob Crothall" <rob@crothall.co.za>
 * @license  GPL 1.0 or later
 * @version  GIT: <git_id>
 * @link     http://www.u3aportalfred.org.za
 */
echo "\t" . '<li class="nav-item"><a class="nav-link active" aria-current="page" href="../index.php">Home</a></li>' . "\n";
echo '<li class="nav-item"><a class="nav-link" href="#contact">Contact us</a></li>' . "\n";
if ($_SESSION["id"] !== "0") {
  echo '<li class="nav-item"><a class="nav-link" href="../page/password.php">Password</a></li>' . "\n";
  echo '<li class="nav-item"><a class="nav-link" href="../page/recordings.php">Recordings</a></li>' . "\n";
  echo '<li class="nav-item"><a class="nav-link" href="../page/logout.php">Log off</a></li>' . "\n";
  echo '<li class="nav-item dropdown">' . "\n";
  echo '<a class="nav-link dropdown-toggle" href="#" id="setupMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Setup</a>' . "\n";
  echo '<ul class="dropdown-menu" aria-labelledby="setupMenuLink">' . "\n";
  echo '<li><a class="dropdown-item" href="../page/payments_list.php">View Payments</a></li>' . "\n";
  echo '<li><a class="dropdown-item" href="../page/payments_add.php">Add Payments</a></li>' . "\n";
  echo '<li><a class="dropdown-item" href="../page/payments_edit.php">Edit payment details</a></li>' . "\n";
  echo '<li><a class="dropdown-item" href="../page/payments_delete.php">Delete payments</a></li>' . "\n";
  echo '</ul>' . "\n";
} else {
  echo '<li class="nav-item"><a class="nav-link" href="../page/register.php">Register</a></li>' . "\n";
  echo '<li class="nav-item"><a class="nav-link" href="../page/payment.php">Payment</a></li>' . "\n";
  echo '<li class="nav-item"><a class="nav-link" href="../page/login.php">Login</a></li>' . "\n";
  echo "</ul>\n";
}
?>
    </div>
  </div>
