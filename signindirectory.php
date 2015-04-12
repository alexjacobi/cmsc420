<?php
include "database.php";
session_start();
$con=mysql_connect($DB_HOST,$DB_USER,$DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error()); $db=mysql_select_db($DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());

$query = mysql_query("SELECT * FROM usertable where email = '".$_POST['user']."' AND password = '".$_POST['pass']."' ") or die(mysql_error());
$row = mysql_fetch_array($query);
if ($row['email']) {

$_SESSION['user'] = $_POST['user'];
$_SESSION['password'] = $_POST['pass'];
    header('Location: home.php'); 
 }
else {

  header('Refresh:2; url=login.php');
  echo 'The email and/or password entered could not be found. Please try again. You will be redirected back to the log in page';
  session_destroy();
}
  
?>