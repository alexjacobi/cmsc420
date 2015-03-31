<?php
include "../database.php";
$con=mysql_connect($DB_HOST,$DB_USER,$DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error()); $db=mysql_select_db($DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());
$_accountName = $_POST[name1];
$_accountType = $_POST[type];
$_remove = $_POST[remove];
$_alter = $_POST[submitBtn];

$_SESSION['user'] = $_POST['user'];
$_SESSION['password'] = $_POST['pass'];

print $_SESSION['user'];

$query = mysql_query("SELECT * FROM usertable where email = '$_SESSION[user]' AND password = '$_SESSION[password]'") or die(mysql_error());
$row = mysql_fetch_array($query);
if($_alter == 'Save New Account') {
	$query1 = mysql_query("INSERT INTO accounts (username, account_name, account_type, balance) VALUES ('".$row[email]."', '$_accountName', '$_accountType', 0)");
}
if($_alter == 'Remove Selected Account') {
	$query2 = mysql_query("DELETE FROM accounts WHERE account_name = '$_remove'");
}



mysql_close($con);

header('Location: ../home.php');

?>