<?php
session_start();
include "../database.php";
$con=mysql_connect($DB_HOST,$DB_USER,$DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error()); $db=mysql_select_db($DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());
if (empty($_SESSION['user'])) {
$_SESSION['user'] = $_POST['user'];
$_SESSION['password'] = $_POST['pass'];
}
$query = mysql_query("SELECT * FROM accounts WHERE username = '$_SESSION[user]' and account_name = '$_SESSION[account_name]'");
$row = mysql_fetch_array($query);
$_current = $row[balance] + $_POST[amount];

mysql_query("INSERT into transactions (username, account_name, transaction_type, amount, date, payee_comments, category, current_balance) values ('".$_SESSION['user']."',"."'".$_SESSION['account_name']."'".","."'".$_POST[type]."'".","."'".$_POST[amount]."'".","."'".$_POST[date]."'".","."'".$_POST[comments]."'".","."'".$_POST[category]."', $_current)");
mysql_query("UPDATE accounts SET balance = '$_current' WHERE username = '$_SESSION[user]' AND account_name = '$_SESSION[account_name]'");

header('Location: ../transactions.php?id='.$_SESSION[account_name]); 
?>
