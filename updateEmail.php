<?php
include "database.php";
session_start();

$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error()); $db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());
$query = mysql_query("SELECT * FROM userTable where email = '$_SESSION[user]' AND password = '$_SESSION[password]'") or die(mysql_error());
$row = mysql_fetch_array($query);

$firstname = $row['first_name'];
$lastname = $row['last_name'];

if ($row['email']) {
echo '
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>
<body>
<div class="container-fluid">
<div class="content-main">
<ul class="nav nav-tabs" role="tablist">
  <li class="active"><a href="clientDefault.php">Home</a></li>
  <li><a >Request New Job</a></li>
  <li><a href="clientJobs.php">View Jobs</a></li>
  <li><a href = "clientSettings.php">Settings</a></li>
</ul>
<div class="row">
<div class="center-block">
<center>
  <div class="form-group">
    <label for="OldPassword">Old Password</label>
    <input type="password" class="form-control" name="OldPassword" placeholder="Enter Old Password:">
  </div>
  <div class="form-group">
    <label for="NewPassword">New Password</label>
    <input type="password" class="form-control" name="Confirm1" placeholder="Enter New Password:">
  </div>
  <div class="form-group">
    <label for="Confirm1">Confirm New Password</label>
    <input type="password" class="form-control" name="Password1" placeholder="Re-enter New Password:">
  </div>
  <button type="submit" class="btn btn-default">Submit Changes</button>
</div>
</center>
<ul class="nav navbar-fixed-bottom">
<center>
        <li><a href="logout.php">Logout</a></li></center>
        </ul>
</div>
</div>
</div>
</div>
</body>
</html>';
}
?>