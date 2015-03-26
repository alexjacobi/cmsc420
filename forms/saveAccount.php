<?php
include "../database.php";
$con=mysql_connect($DB_HOST,$DB_USER,$DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error()); $db=mysql_select_db($DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());
$_accountName = $_POST[name1];
$_accountType = $_POST[type];
$_remove = $_POST[remove];
$_alter = $_POST[submitBtn];

if($_alter == 'Save New Account') {
	$query = mysql_query("INSERT INTO accounts (account_name, account_type) VALUES ('$_accountName', '$_accountType')");
	echo '<center><a href="home.php"></a></center>';
	echo "Entered new account successfully\n";
}
if($_alter == 'Remove Selected Account') {
	$query2 = mysql_query("DELETE FROM accounts WHERE account_name = '$_remove'");
}



mysql_close($con);

header('Location: ../home.php');

?>