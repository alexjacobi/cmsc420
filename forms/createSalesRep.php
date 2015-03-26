<?php
include "../database.php";
$con=mysql_connect($DB_HOST,$DB_USER,$DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error()); $db=mysql_select_db($DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());
$_email = $_POST[Email1];
$_password = $_POST[Password1];
$_firstname = $_POST[FirstName1];
$_lastname = $_POST[LastName1];
$_company = $_POST[Company1];
$_industry = $_POST[Industry1];
$_phone = $_POST[PhoneNumber1];
$_address = $_POST[Address1];
$_city = $_POST[City1];
$_zip = $_POST[Zip1];
$_state = $_POST[State1];
$query = mysql_query("INSERT INTO userTable (email, password, first_name, last_name, company, industry, phone_number, address, city, zip_code, state, type) VALUES ('$_email', '$_password', '$_firstname', '$_lastname', '$_company', '$_industry', '$_phone', '$_address', '$_city', '$_zip', '$_state', 'sales_rep')");

mysql_close($con);

header('Location: ../salesreps.php');   
?>