<?php
session_start();
include "../database.php";

$con=mysql_connect($DB_HOST,$DB_USER,$DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error()); $db=mysql_select_db($DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());
$query = mysql_query("SELECT * FROM userTable where email = '$_SESSION[user]' AND password = '$_SESSION[password]'") or die(mysql_error());
$row = mysql_fetch_array($query);
if ($row['email']) {

$splitup = explode(' ', $_POST[sales_rep]);

$assigner = mysql_query("UPDATE jobs SET first_name_sales_rep='$splitup[0]', last_name_sales_rep='$splitup[1]', status='active' WHERE id='$_POST[id]'");

header('Location: ../ij.php');
}
?>