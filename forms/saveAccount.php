<?php
include "../database.php";
session_start();
$con=mysql_connect($DB_HOST,$DB_USER,$DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error()); $db=mysql_select_db($DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());
$_accountName = $_POST[name1];
$_accountType = $_POST[type];
$_remove = $_POST[remove];
$_alter = $_POST[submitBtn];
$_new = $_POST[name];

$_accountName = $_SESSION['account_name'];
$_user = $_SESSION['user'];

$query = mysql_query("SELECT * FROM usertable where email = '$_user'") or die(mysql_error());
$row = mysql_fetch_array($query);
if($_alter == 'Save New Account') {
	$query1 = mysql_query("INSERT INTO accounts (username, account_name, account_type, balance) VALUES ('".$row[email]."', '$_accountName', '$_accountType', 0)");
}
if($_alter == 'Remove Selected Account') {
	$query2 = mysql_query("DELETE FROM accounts WHERE account_name = '$_remove'");
}
if($_alter == 'Submit') {
	$query3 = mysql_query("UPDATE accounts SET account_name = '$_new' WHERE username = '$_user' AND account_name = '$_accountName'");
	$query4 = mysql_query("UPDATE transactions SET account_name = '$_new' WHERE username = '$_user' AND account_name = '$_accountName'");
}




mysql_close($con);

header('Location: ../home.php');

?>