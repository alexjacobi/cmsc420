<?php
include "../database.php";
session_start();
$con=mysql_connect($DB_HOST,$DB_USER,$DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error()); $db=mysql_select_db($DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());
$_accountName = $_POST[name1];
$_accountType = $_POST[type];
$_remove = $_POST[remove];
$_alter = $_POST[submitBtn];
$_new = $_POST[name];
$_user = $_SESSION['user'];
$_old = $_SESSION['account_name'];

$query = mysql_query("SELECT * FROM accounts where username = '$_user' AND account_name = '$_accountName'") or die(mysql_error());

while($row = mysql_fetch_array($query)){
	if($_accountName == $row[account_name] && $_accountType ==  $row[account_type]) {
		header('Refresh: 5; URL=../addNewAccount.php');
		die("The account name and type you entered is already in use. You will now e redirected back to the previous screen.");
	}
}
if($_alter == 'Save New Account') {
	$query1 = mysql_query("INSERT INTO accounts (username, account_name, account_type, balance) VALUES ('$_user', '$_accountName', '$_accountType', 0)");
}
if($_alter == 'Remove Selected Account') {
	$query2 = mysql_query("DELETE FROM accounts WHERE account_name = '$_remove'");
}
if($_alter == 'Submit') {
	$query3 = mysql_query("UPDATE accounts SET account_name = '$_new' WHERE username = '$_user' AND account_name = '$_old'");
	$query4 = mysql_query("UPDATE transactions SET account_name = '$_new' WHERE username = '$_user' AND account_name = '$_old'");
}




mysql_close($con);

header('Location: ../home.php');

?>