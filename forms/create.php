<?php
include "../database.php";
$con=mysql_connect($DB_HOST,$DB_USER,$DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error()); $db=mysql_select_db($DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());

$_email = $_POST[Email1];
$_password = $_POST[Password1];
$_confirm = $_POST[Confirm1];
$_firstname = $_POST[FirstName1];
$_lastname = $_POST[LastName1];

$query = mysql_query("SELECT * FROM usertable WHERE email = '$_email'");
$row = mysql_fetch_array($query);

if(empty($_email)||empty($_password)||empty($_confirm)||empty($_firstname)||empty($_lastname))
{
	header('Refresh: 5; URL=../signup.php');
	die('Input must be provided for all fields. Please try again. You will be redirected back to the sign up page.');
}

if(!mysqli_num_rows($row))
{
	header('Refresh: 5; URL=../signup.php');
	die ('An account with this email address already exists. Please try again with a different email address. You will now be redirected to the sign up page');
}

if($_password == $_confirm) 
{
	$query = mysql_query("INSERT INTO usertable (email, password, first_name, last_name) VALUES ('$_email', '$_password', '$_firstname', '$_lastname')");
}
else
{
	header('Refresh: 5; URL=../signup.php');
	die ('Passwords didn\'t match. You will now be redirected to the sign up page.');
}
	

mysql_close($con);

header('Location: ../login.php');   

?>