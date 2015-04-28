<?php
session_start();
include "../database.php";
$con=mysql_connect($DB_HOST,$DB_USER,$DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error()); $db=mysql_select_db($DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());
if (empty($_SESSION['user'])) {
$_SESSION['user'] = $_POST['user'];
$_SESSION['password'] = $_POST['pass'];
}
$_id = $_GET['id'];
$query=mysql_query("SELECT * FROM transactions WHERE id = '$_id'");
$row = mysql_fetch_array($query);
$query1=mysql_query("SELECT * FROM accounts WHERE username = '$_SESSION[user]' AND account_name = '$row[account_name]'");
$row1 = mysql_fetch_array($query1);

if($row[transaction_type] == 'Income'){
	$_amount = $row[amount] * -1;
	$_current = $row1[balance] + $_amount;
	mysql_query("UPDATE accounts SET balance = '$_current' WHERE username = '$_SESSION[user]' AND account_name = '$row[account_name]'");
	mysql_query("UPDATE transactions SET current_balance = '$_current' WHERE username = '$_SESSION[user]' AND account_name = '$row[account_name]'");

}
if($row[transaction_type] == 'Spending'){
	$_amount = $row[amount] * -1;
	$_current = $row1[balance] + $_amount;
	mysql_query("UPDATE accounts SET balance = '$_current' WHERE username = '$_SESSION[user]' AND account_name = '$row[account_name]'");
	mysql_query("UPDATE transactions SET current_balance = '$_current' WHERE username = '$_SESSION[user]' AND account_name = '$row[account_name]'");
}
mysql_query("DELETE FROM transactions WHERE id = '$_id'");
header('Location: ../transactions.php?id='.$_SESSION[account_name]); 
?>
