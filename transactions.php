<?php
session_start();
include "database.php";

$con = mysql_connect($DB_HOST, $DB_USER, $DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
$db = mysql_select_db($DB_NAME, $con) or die("Failed to connect to MySQL: " . mysql_error());
$query = mysql_query("SELECT * FROM usertable where email = '$_SESSION[user]' AND password = '$_SESSION[password]'") or die(mysql_error());
$row        = mysql_fetch_array($query);
$acct_query = mysql_query("SELECT * FROM accounts where username='$_SESSION[user]' AND account_name='$_GET[id]'");
$row1       = mysql_fetch_array($acct_query);

$_accountName             = $_GET['id'];
$_SESSION['account_name'] = $_accountName;
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
  document.getElementById("mytable").innerHTML = document.getElementById("mytable").innerHTML + "<tr><td><center><input type=text size=12 name=date></center></td><td><center><input type=text size=12 name=type></center></td><td><center><input type=text size=12 name=category></center></td><td><center><input type=text size=12 name=comments></center></td><td><center><input type=text size=12 name=amount></center></td><td><center><input type=submit value=add></center></td></tr></table></form>";
}
</script>
<script type="text/javascript">
function confirm_alert(node) {
    return confirm("This transaction will now be deleted.");
}
</script>

<script type="text/javascript">
function changeContent(){
    var x=document.getElementById("myTable").rows
    var y=x[0].cells
    y[0].innerHTML="NEW CONTENT"
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
<h3>' . $row1['account_name'] . ' ';
    echo '</h3>
<li><a href="accountSettings.php">Change Account Name</a></li>
</div>
</div>
<div class="row">
<div class="center-block">
<form method=POST action=forms/add_trans.php>
<table id="mytable" class="table table-condensed">
<tr>
<td><p class="text-center">Date</p></td>
<td><p class="text-center">Type</p></td>
<td><p class="text-center">Category</p></td>
<td><p class="text-center">Comments/Payee</p></td>
<td><p class="text-center">Amount</p></td>
<td><p class="text-center">Balance</p></td>
<td><p class="text-center">Options</p></td>

</tr>';
    
    $table_query = mysql_query("SELECT * FROM transactions where account_name='$_accountName' ORDER BY date");
    while ($row = mysql_fetch_array($table_query)) {
        echo '<tr>';
        echo '<td><p class="text-center"><small>' . $row[date] . '</small></p></td>';
        echo '<td><p class="text-center"><small>' . $row[transaction_type] . '</small></p></td>';
        echo '<td><p class="text-center"><small>' . $row[category] . '</small></p></td>';
        echo '<td><p class="text-center"><small>' . $row[payee_comments] . '</small></p></td>';
        echo '<td><p class="text-center"><small>' . $row[amount] . '</small></p></td>';
        echo '<td><p class="text-center"><small>' . $row[current_balance] . '</small></p></td>';
        echo '<td><p class="text-center"><small><a href="" onclick="changeContent(this)" value="Change content">Edit </a></small>|<small><a href="forms\delete_trans.php?id=' . $row[id] . '" onclick="return confirm_alert(this);"> Delete</a></small></p></td></tr>';
    }
    echo '
</div>
<div style="text-align:center">
  <input type="button" onClick="myFunction()" value="Add Transaction">
</div>

</div>
</div>
</div>
</body>
</html>';
}
?>