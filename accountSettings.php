<?php
include "database.php";
session_start();
$con=mysql_connect($DB_HOST,$DB_USER,$DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error()); $db=mysql_select_db($DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());

$_accountName = $_SESSION['account_name'];
$_SESSION['account_name'] = $_accountName;

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
function confirmation() {
  var answer = confirm("Remove Selected Account")
  if (answer){
    window.location = "forms/saveAccount.php";
  }
  else{
    window.location = "addNewAccount.php";
  }
}
</script>
</head>
<body>
<div class="container-fluid">
<div class="content-main">
<ul class="nav nav-tabs" role="tablist">
  <li><a href="home.php">Home</a></li>
</ul><center>
</center>
<div class="content-main">
<center>
<form action="forms/saveAccount.php" method="post">
    <center>
    <h1>Edit Account Name</h1>
  </center>
  <label for="name1">New Name:</label>
    <input type="text" class="form-control" name="name" placeholder="Enter New Account Name">
  <p>
  <p>
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