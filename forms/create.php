<?php
include "../database.php";
$con=mysql_connect($DB_HOST,$DB_USER,$DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error()); $db=mysql_select_db($DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());

$_email = $_POST[Email1];
$_password = $_POST[Password1];
$_confirm = $_POST[Confirm1];
$_firstname = $_POST[FirstName1];
$_lastname = $_POST[LastName1];

if($_password == $_confirm) 
{
$query = mysql_query("INSERT INTO usertable (email, password, first_name, last_name) VALUES ('$_email', '$_password', '$_firstname', '$_lastname')");}
else
{
die ('Passwords didn\'t match. Please hit the back button and try again.');
}
	

mysql_close($con);

header('Location: ../login.php');   

?>