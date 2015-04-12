<?php
session_start();
include "../database.php";
$con=mysql_connect($DB_HOST,$DB_USER,$DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error()); $db=mysql_select_db($DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());
if (empty($_SESSION['user'])) {
$_SESSION['user'] = $_POST['user'];
$_SESSION['password'] = $_POST['pass'];
}

mysql_query("INSERT into transactions (username, account_name, transaction_type, amount, date, payee_comments, category) values ('".$_SESSION['user']."',"."'".$_SESSION['account_name']."'".","."'".$_POST[type]."'".","."'".$_POST[amount]."'".","."'".$_POST[date]."'".","."'".$_POST[comments]."'".","."'".$_POST[category]."')");
header('Location: ../transactions.php?id='.$_SESSION[account_name]); 
?>
