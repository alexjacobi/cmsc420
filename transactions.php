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
<script>
var p = {
                deleteRow: function(row) {
                document.getElementById("mytable").deleteRow(row.rowIndex);
                }
            };
function myFunction() {
  document.getElementById("mytable").innerHTML = document.getElementById("mytable").innerHTML + "<tr><td><small><input type=text></small></p></td><td><small><input type=text></small></p></td><td><small><input type=text></small></p></td><td><small><input type=text></small></td><td><small><input type=text></small></td><td><small><input type=text></small></td><td><small><br></tr>";
}
</script>
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
';
$query = mysql_query("SELECT * FROM usertable where email = '$_SESSION[user]' AND password = '$_SESSION[password]'") or die(mysql_error());
$row = mysql_fetch_array($query);

echo '<div class="well">
<h3>'.$row['first_name'].' '.$row['last_name']; 
echo'</h3>
</center>
</div>
<div class="row">
<div class="center-block">
<table id="mytable" class="table table-condensed">
<tr>
<td><p class="text-center">Date</p></td>
<td><p class="text-center">Type</p></td>
<td><p class="text-center">Category</p></td>
<td><p class="text-center">Comments/Payee</p></td>
<td><p class="text-center">Amount</p></td>
<td><p class="text-center">Balance</p></td>
</tr>';

$table_query = mysql_query("SELECT * FROM transactions where account_name='$_accountName'");
while ($row = mysql_fetch_array($table_query)) {
  echo '<tr>';
  echo '<td><p class="text-center"><small>'.$row[date].'</small></p></td>';
  echo '<td><p class="text-center"><small>'.$row[transaction_type].'</small></p></td>';
  echo '<td><p class="text-center"><small>'.$row[category].'</small></p></td>';
  echo '<td><p class="text-center"><small>'.$row[payee_comments].'</small></p></td>';
  echo '<td><p class="text-center"><small>'.$row[amount].'</small></p></td>';
  echo '<td><p class="text-center"><small></small></p></td>';
  echo '<td><p class="text-center"><small><br></tr>';
}

echo' 
<div style="text-align:center">
  <input type="button" onClick="myFunction()" value="Add New Transaction">
</div>';
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