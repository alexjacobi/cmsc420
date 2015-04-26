<?php
include "../database.php";
$con=mysql_connect($DB_HOST,$DB_USER,$DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error()); $db=mysql_select_db($DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());
echo '
<html>
<head>
<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
</head>
<body>
<div class="container-fluid">
<div class="content-main">
<ul class="nav nav-tabs" role="tablist">
  <li><a href="home.php">Home</a></li>
  ';
    $query2 = mysql_query("SELECT * FROM accounts WHERE username = '$_SESSION[user]'") or die(mysql_error());
    while ($row = mysql_fetch_array($query2)) {
        echo "<li><a href='transactions.php?id=" . $row['account_name'] . "&type=" . $row['account_type'] . "'>" . $row['account_name'] . " " . $row['account_type'] . "</a></li>";
        
    }
    echo "</select>";
    echo '

</ul>
<center>
';
    $query = mysql_query("SELECT * FROM usertable where email = '$_SESSION[user]' AND password = '$_SESSION[password]'") or die(mysql_error());
    $row = mysql_fetch_array($query);
    
    echo '<div class="well">
<h3>'.$_POST[type];
    echo '</h3>
</div>
</div>
<div class="row">
<div class="center-block">
<table id="mytable" class="table table-condensed"><tr>
<td><p class="text-center">Date</p></td>
<td><p class="text-center">Type</p></td>
<td><p class="text-center">Category</p></td>
<td><p class="text-center">Comments/Payee</p></td>
<td><p class="text-center">Amount</p></td>
<td><p class="text-center">Balance</p></td>
<td><p class="text-center">Options</p></td>

</tr>';
$table_query = mysql_query("SELECT * FROM transactions where transaction_type='".$_POST[type]."' and date >='".$_POST['start']."' and date <= '".$_POST['end']."'");
    while ($row = mysql_fetch_array($table_query)) {
        echo '<tr id="'.$row[id].'">';
        echo '<td><p class="text-center"><small>' . $row[date] . '</small></p></td>';
        echo '<td><p class="text-center"><small>' . $row[transaction_type] . '</small></p></td>';
        echo '<td><p class="text-center"><small>' . $row[category] . '</small></p></td>';
        echo '<td><p class="text-center"><small>' . $row[payee_comments] . '</small></p></td>';
        echo '<td><p class="text-center"><small>' . $row[amount] . '</small></p></td>';
        echo '<td><p class="text-center"><small>' . $row[current_balance] . '</small></p></td>';
        echo '<td><p class="text-center"><small><a href="javascript:changeContent('.$row[id].')" value="Change content">Edit </a></small>|<small><a href="forms\delete_trans.php?id=' . $row[id] . '" onclick="return confirm_alert(this);"> Delete</a></small></p></td>
        </tr>';
    }
echo '</table></body></html>';
mysql_close($con);

?>