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
  <h1>Add New Account</h1>
</center>
<div class="content-main">
<center>
<form action="forms/saveAccount.php" method="post">
  <div class="form-group">
    <label for="name1">Account Name:</label>
    <input type="text" class="form-control" name="name1" placeholder="Enter New Account Name">
  </div>
   <select name="type">
    <option value="">Select Account Type</option>
    <option value="Savings">Savings</option>
    <option value="Checking">Checking</option>
    <option value="Certificate of Deposit">Certificate of Deposit</option>
    <option value="Money Market">Money Market</option>
    <option value="Credit Card">Credit Card</option>
</select><br>
<br>
  <input name="submitBtn" type="submit" value="Save New Account">
  <center>
    <h1>Remove Account</h1>
  </center>
  ';
  $query2 = mysql_query("SELECT DISTINCT account_name FROM accounts ORDER BY account_type;") or die(mysql_error());
  echo "<select id='remove' name='remove'>";
    echo "<option value=''>Select Account to Remove</option>";
    while ($row = mysql_fetch_array($query2)) {
        echo "<option value='" . $row['account_name'] . "'>" . $row['account_name'] . "</option>";
    }
  echo "</select>";
  echo '
  <p>
  <p>
  <input name="submitBtn" type="submit" onclick="confirmation()" value="Remove Selected Account">
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