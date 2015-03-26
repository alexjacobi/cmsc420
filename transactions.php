<?php
session_start();
include "../database.php";

$con=mysql_connect($DB_HOST,$DB_USER,$DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error()); $db=mysql_select_db($DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());
$query = mysql_query("SELECT * FROM userTable where email = '$_SESSION[user]' AND password = '$_SESSION[password]'") or die(mysql_error());
$row = mysql_fetch_array($query);

$firstname = $row['first_name'];
$lastname = $row['last_name'];

if ($row['email']) {
  echo '<html>
<head>
<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
</head>
<body>
<div class="container-fluid">
<div class="content-main">
<ul class="nav nav-tabs" role="tablist">
  <li><a href = "clientDefault.php">Home</a></li>
  <li><a href= "request.php">Request New Job</a></li>
  <li class="active" ><a href="activeJobsClient.php">Active Jobs</a></li>
  <li><a href="inactiveClientJobs.php">Inactive Jobs</a></li>
  <li><a href = "clientSettings.php">Settings</a></li>

</ul>
<center>
<div class="well">
<h3>Active Jobs</h3>
</center>
</div>
<div class="row">
<div class="center-block">
<table class="table table-condensed">
<tr>
<td><p class="text-center">Job #</p></td>
<td><p class="text-center">Sales Rep</p></td>
<td><p class="text-center">Status</p></td>
<td><p class="text-center">Location</p></td>
<td><p class="text-center">View PDF</p></td>
</tr>';

$table_query = mysql_query("SELECT * FROM jobs where first_name_client = '$firstname' and last_name_client = '$lastname' and status='active'");
while ($row = mysql_fetch_array($table_query)) {
    $j_query = mysql_query("SELECT * FROM jobs where id = '$row[id]'" );
  $tgrow = mysql_fetch_array($j_query);
  echo '<tr>';
  echo '<td><p class="text-center"><small><a href="j_c.php?id='.$row[id].'">'.$row[id].'</a></small></p></td>';
  echo '<td><p class="text-center"><small><a href="s_c.php?f='.$row[first_name_sales_rep].'&l='.$row[last_name_sales_rep].'">'.$row[first_name_sales_rep].' '.$row[last_name_sales_rep].'</a></small></p></td>';
  echo '<td><p class="text-center"><small>'.$row[status].'</small></p></td>';
  echo '<td><p class="text-center"><small>'.$row[location].'</small></p></td>';
  echo '<td><p class="text-center"><small>';

  if ($tgrow[pdf] == 'Yes') {
    echo '<a href="../forms/orders/'.$row[id].'.pdf'.'">PDF</a>';
  }
  echo '</small></p></td>';
  //echo $row[client];
  echo '</tr>';
}

echo '
</table>
</div>
<ul class="nav navbar-fixed-bottom">
<center>
        <li><a href="../logout.php">Logout</a></li></center>
        </ul>
</div>
</div>
</div>
</div>
</body>
</html>';
}
?>