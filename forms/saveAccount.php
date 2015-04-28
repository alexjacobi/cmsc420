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
$_type = $_SESSION['account_Type'];

$query = mysql_query("SELECT * FROM accounts where username = '$_user' AND account_name = '$_accountName'") or die(mysql_error());

while($row = mysql_fetch_array($query)){
	if($_accountName == $row[account_name] && $_accountType ==  $row[account_type]) {
		header('Refresh: 5; URL=../addNewAccount.php');
		die("The account name and type you entered is already in use. You will now be redirected back to the previous screen.");
	}
}
if($_alter == 'Save New Account') {
	mysql_query("INSERT INTO accounts (username, account_name, account_type, balance) VALUES ('$_user', '$_accountName', '$_accountType', 0)");
}
if($_alter == 'Remove Selected Account') {
	mysql_query("DELETE FROM accounts WHERE account_name = '$_old'");
	mysql_query("DELETE FROM transactions WHERE account_name = '$_old' AND username = '$_user'");
}
$result = mysql_query("SELECT * FROM accounts WHERE username = '$_user' AND account_name = '$_new' AND account_type = '$_type'");
if($_alter == 'Submit' && mysql_num_rows($result) == 0) {
	mysql_query("UPDATE accounts SET account_name = '$_new' WHERE username = '$_user' AND account_name = '$_old'");
	mysql_query("UPDATE transactions SET account_name = '$_new' WHERE username = '$_user' AND account_name = '$_old'");
}
else{
	header('Refresh: 5; URL=../accountSettings.php');
	die("There already exists an account with that name and type. You will now be redirected back to the previous page.");
}




mysql_close($con);

header('Location: ../home.php');

?>