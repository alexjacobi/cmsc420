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
  <li><a href="../home.php">Home</a></li>
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
';
if($_POST[type] == Income)
{
    echo'
<table id="mytable" class="table table-condensed"><tr>
<td><p class="text-center">Amount</p></td>
<td><p class="text-center">Category</p></td>
<td><p class="text-center">Date</p></td>
</tr>';
$table_query = mysql_query("SELECT * FROM transactions where transaction_type='".$_POST[type]."' and date >='".$_POST['start']."' and date <= '".$_POST['end']."'");
$total_query = mysql_query("SELECT SUM(amount) AS sum FROM transactions WHERE transaction_type = 'Income' AND date >='".$_POST['start']."' and date <= '".$_POST['end']."'"); 
$row1 = mysql_fetch_array($total_query); 
$total = $row1[sum];
    while ($row = mysql_fetch_array($table_query)) {
        echo '<tr id="'.$row[id].'">';
        echo '<td><p class="text-center"><small>$' . $row[amount] . '</small></p></td>';
        echo '<td><p class="text-center"><small>' . $row[category] . '</small></p></td>';
        echo '<td><p class="text-center"><small>' . $row[date] . '</small></p></td>
        </tr>';
    }
    echo'
    <table id="total" class="table table-condensed"><tr>
    <td><p class="text-center">Total Income:</p></td>
    <td><p class="text-center">$'. $total .'</p></td>
    </tr>';
}

if($_POST[type] == Spending)
{
    echo'
<table id="mytable" class="table table-condensed"><tr>
<td><p class="text-center">Category</p></td>
<td><p class="text-center">Payee</p></td>
<td><p class="text-center">Amount</p></td>
<td><p class="text-center">Date</p></td>
</tr>';
$table_query = mysql_query("SELECT * FROM transactions where transaction_type='".$_POST[type]."' AND date >='".$_POST['start']."' and date <= '".$_POST['end']."'");
$total_query = mysql_query("SELECT SUM(amount) AS sum FROM transactions WHERE transaction_type = 'Spending' AND date >='".$_POST['start']."' and date <= '".$_POST['end']."'"); 
$row1 = mysql_fetch_array($total_query); 
$total = $row1[sum];
    while ($row = mysql_fetch_array($table_query)) {
        echo '<tr id="'.$row[id].'">';
        echo '<td><p class="text-center"><small>' . $row[category] . '</small></p></td>';
        echo '<td><p class="text-center"><small>' . $row[payee_comments] . '</small></p></td>';
        echo '<td><p class="text-center"><small>$' . $row[amount]*-1 . '</small></p></td>';
        echo '<td><p class="text-center"><small>' . $row[date] . '</small></p></td>
        </tr>';
    }
    echo'
    <table id="total" class="table table-condensed"><tr>
    <td><p class="text-center">Total Expenditures:</p></td>
    <td><p class="text-center">$'. $total*-1 .'</p></td>
    </tr>';
}

if($_POST[type] == Analysis)
{
    echo'
<table id="mytable" class="table table-condensed"><tr>
<td><p class="text-center">Category</p></td>
<td><p class="text-center">Amount</p></td>
<td><p class="text-center">Percentage</p></td>
</tr>';
$table_query = mysql_query("SELECT DISTINCT category FROM transactions WHERE transaction_type= 'Spending' AND date >='".$_POST['start']."' and date <= '".$_POST['end']."'");
$total_query = mysql_query("SELECT SUM(amount) AS sum FROM transactions WHERE transaction_type = 'Spending' AND date >='".$_POST['start']."' and date <= '".$_POST['end']."'"); 
$row1 = mysql_fetch_array($total_query); 
$total = $row1[sum];
    while ($row = mysql_fetch_array($table_query)) {
        $total_category = mysql_query("SELECT SUM(amount) AS sum FROM transactions WHERE transaction_type = 'Spending' and category = '".$row['category']."' AND date >='".$_POST['start']."' and date <= '".$_POST['end']."'"); 
        $row2 = mysql_fetch_array($total_category); 
        $total1 = $row2[sum];
        echo '<tr id="'.$row[id].'">';
        echo '<td><p class="text-center"><small>' . $row[category] . '</small></p></td>';
        echo '<td><p class="text-center"><small>$' . $total1*-1 . '</small></p></td>';
        echo '<td><p class="text-center"><small>' . ($total1/$total)*100 . '%</small></p></td>
        </tr>';
    }
    echo'
    <table id="total" class="table table-condensed"><tr>
    <td><p class="text-center">Total Expenditures:</p></td>
    <td><p class="text-center">$'. $total*-1 .'</p></td>
    </tr>';
}
echo '</table></body></html>';
mysql_close($con);

?>