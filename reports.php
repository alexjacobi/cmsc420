<?php
include "database.php";
session_start();
$con=mysql_connect($DB_HOST,$DB_USER,$DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error()); $db=mysql_select_db($DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());
if (empty($_SESSION['user'])) {
$_SESSION['user'] = $_POST['user'];
$_SESSION['password'] = $_POST['pass'];
}
  
$query = mysql_query("SELECT * FROM usertable where email = '$_SESSION[user]' AND password = '$_SESSION[password]'") or die(mysql_error());
$row = mysql_fetch_array($query);

if ($row['email']) {
  echo '<html>
<head>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<script type="text/javascript">
</script>
</head>
<body>
<div class="container-fluid">
<div class="content-main">
<ul class="nav nav-tabs" role="tablist">
  <li><a href="home.php">Home</a></li>
</ul><center>
  <h1>View Your Financial Reports</h1>
</center>
<div class="content-main">
<center>
<form action="forms/viewReport.php" method="post">
  <div class="form-group">
    <label for="name1">What type of report would you like to view?</label>
  </div>
   <select name="type">
    <option value="">Select Report Type</option>
    <option value="Income">Income</option>
    <option value="st">Spending</option>
    </select><br>
<br>
<div class="form-group">
  <label for="Start_Date">Start Date:</label><br>
  <input type="Date" name="start"></input><br>
</div>
<div class="form-group">
  <label for="End_Date">End Date:</label><br>
  <input type="Date" name="end"></input><br>
</div>
<br>
<br>
  <input name="submitBtn" type="submit" value="Submit">
</form>
</div>
</div>
</div>
</body>
</html>';
  
}
else {
  echo 'DENIED';
}
  
?>