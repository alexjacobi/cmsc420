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

$firstname = $row['first_name'];
$lastname = $row['last_name'];

if ($row['email']) {
echo '
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
</head>
<body>
<div class="container-fluid">
<div class="content-main">
<ul class="nav nav-tabs" role="tablist">
  <li><a href="home.php">Home</a></li>
  ';
  $query2 = mysql_query("SELECT DISTINCT account_name FROM accounts ORDER BY account_type;") or die(mysql_error());
    while ($row = mysql_fetch_array($query2)) {
        echo "<li><a href='transactions.php?id=" . $row['account_name'] . "'>" . $row['account_name'] . "</a></li>";
        
    }
  echo '
</ul>
<div class="row">
<center>
<center>
<div class="well">
<h3>Welcome '.$row['first_name'].'</h3>
</div>
</center>';
echo '<table class="table table-condensed" style="width: auto;"><tr><td>Account name</td><td>Balance</td></tr>';
$query2 = mysql_query("SELECT * FROM accounts ORDER BY account_type;") or die(mysql_error());
$sum = 0;
    while ($row = mysql_fetch_array($query2)) {
        echo "<tr><td>"."<a href='transactions.php?id=" . $row['account_name'] . "'>" . $row['account_name'] . "</a>"."</td>"."<td>$".$row['balance']."</td></tr>";
        $sum = $sum + $row['balance'];
    }
echo '<tr><td>Total:</td><td>$'.$sum.'</td></tr>';
echo '</table>';
echo 'From here you can either add new accounts or view existing accounts by selecting a tab avove.</br>
<a href="addNewAccount.php">Add/Delete Accounts</a><br>
<a href="reports.php">View Financial Reports</a>
</center>
</div>
<ul class="nav navbar-fixed-bottom">
<center>
        <li><a href="logout.php">Logout</a></li></center>
        </ul>
</div>
</div>
</div>
</body>
</html>';
}
?>