<?php
session_start();
include "../database.php";
$con=mysql_connect($DB_HOST,$DB_USER,$DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error()); $db=mysql_select_db($DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());
if (empty($_SESSION['user'])) {
$_SESSION['user'] = $_POST['user'];
$_SESSION['password'] = $_POST['pass'];
}
$_id = $_GET['id'];
mysql_query("DELETE FROM transactions WHERE id = '$_id'");
header('Location: ../transactions.php?id='.$_SESSION[account_name]); 
?>
