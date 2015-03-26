<?php
include "database.php";
session_start();
$con=mysql_connect($DB_HOST,$DB_USER,$DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error()); $db=mysql_select_db($DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());
$_OldPassword = $_POST[OldPassword];
$_NewPassword = $_POST[NewPassword];
$_NewPassword1 = $_POST[NewPassword1];

if (empty($_SESSION['user'])) {
$_SESSION['user'] = $_POST['user'];
$_SESSION['password'] = $_POST['pass'];
}

$_User = $_SESSION['user'];

if($_OldPassword == $_SESSION['password']) {
	if($_NewPassword == $_NewPassword1)
	{
		$query = mysql_query("UPDATE userTable SET password = '$_NewPassword' WHERE email = '$_User' ") or die(mysql_error());
		header('Location: logout.php'); 
	}
	else
	{
		echo "Both New Passwords Do not Match";
	}
}
else
{
	echo "Denied";
}

mysql_close($con);

?>