<?php
include "database.php";
session_start();

$con=mysql_connect($DB_HOST,$DB_USER,$DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error()); $db=mysql_select_db($DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());
if (empty($_SESSION['user'])) {
$_SESSION['user'] = $_POST['user'];
$_SESSION['password'] = $_POST['pass'];
}
  
$query = mysql_query("SELECT * FROM userTable where email = '$_SESSION[user]' AND password = '$_SESSION[password]'") or die(mysql_error());
$row = mysql_fetch_array($query);

if ($row['email']) {
  echo '<html>
<head>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>
<body>
<div class="container-fluid">
<div class="content-main">
<center>
  <h1>Update Password</h1>
</center>
<div class="content-main">
<center>
<form role="form" method="POST" action="SaveNewPassword.php">
  <div class="form-group">
    <label for="OldPassword">Old Password:</label>
    <input type="text" class="form-control" name="OldPassword" placeholder="Enter Old Password:">
  </div>
  <div class="form-group">
    <label for="NewPassword">New Password:</label>
    <input type="text" class="form-control" name="NewPassword" placeholder="Enter New Password:">
  </div>
  <div class="form-group">
    <label for="NewPassword1">New Password:</label>
    <input type="text" class="form-control" name="NewPassword1" placeholder="Enter New Password:">
  </div>
  <input name="submitBtn" type="submit" value="Update Password">
  <div>
    * After you click Update Password you will be redirected to the login page.
  </div>
</form>
</div>
<ul class="nav navbar-fixed-bottom">
<center>
        <li><a href="logout.php">Logout</a></li></center>
        </ul>
</body>
</html>';
  
}
else {
  echo 'DENIED';
}
  
?>