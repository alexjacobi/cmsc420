<?php
session_start();
include "database.php";

$con=mysql_connect($DB_HOST,$DB_USER,$DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error()); $db=mysql_select_db($DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());
$query = mysql_query("SELECT * FROM usertable where email = '$_SESSION[user]' AND password = '$_SESSION[password]'") or die(mysql_error());
$row = mysql_fetch_array($query);

$_accountName = $_GET['id'];

if ($row['email']) {
  echo '<html>
<head>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
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
  echo "</select>";
  echo '

</ul>
<center>
<div class="well">
<h3>Transactions</h3>
</center>
</div>
<div class="row">
<div class="center-block">
<table class="table table-condensed">
<tr>
<td><p class="text-center">Account Name</p></td>
<td><p class="text-center">Transaction Amount</p></td>
<td><p class="text-center">Transaction Type</p></td>
<td><p class="text-center">Date</p></td>
</tr>';

$table_query = mysql_query("SELECT * FROM transactions where account_name='$_accountName'");
while ($row = mysql_fetch_array($table_query)) {
    $j_query = mysql_query("SELECT * FROM jobs where id = '$row[id]'" );
  $tgrow = mysql_fetch_array($j_query);
  echo '<tr>';
  echo '<td><p class="text-center"><small>'.$row[account_name].'</small></p></td>';
  echo '<td><p class="text-center"><small>'.$row[amount].'</small></p></td>';
  echo '<td><p class="text-center"><small>'.$row[transaction_type].'</small></p></td>';
  echo '<td><p class="text-center"><small>'.$row[date].'</small></p></td>';
  echo '<td><p class="text-center"><small>';
}

echo '
</table>
</div>
<ul class="nav navbar-fixed-bottom">
<center>
        <li><a href="accountSettings.php">Account Options</a></li></center>
        </ul>
</div>
</div>
</div>
</div>
</body>
</html>';
}
?>