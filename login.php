<?php
include "database.php";
session_start();
$con=mysql_connect($DB_HOST,$DB_USER,$DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error()); $db=mysql_select_db($DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());

echo '
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">

</head>
<body>


<div class="container-fluid">
<div class="content-main">
<center>
<style type="text/css">
      .col1 {
          width:50%;
          height: 50%;
          float:left;
          display: inline-block;
          margin-top: 10%;
          margin-bottom: 50%;
          border: 1px solid black;
          border-right-style: solid;
          border-left-style: none;
          border-bottom-style: none;
          border-top-style: none;
          padding:0px 0px 0px 0px;
      }
      .col2 {
          width:50%;
          height: 50%;
          display: inline-block;
          margin-top: 10%;
          margin-bottom: 50%;
          float:right;
          border: 1px solid black;
          border-right-style: solid;
          border-left-style: none;
          border-bottom-style: none;
          border-right-style: none;
          border-top-style: none;
      }
}
    </style>
    <div class="col2">
    <center>
<h3>Login</h3>
<br>
<form role="form" method="POST" action="signindirectory.php">
  <div class="form-group">
  <table>
  <tr>
  <td>
    <h6>Email Address: </h6>
    </td>
    <td>
    <input type="email" class="input" name="user" id="InputEmail1" placeholder="Email">
    </td>
    </tr>
  </div>

  <div class="form-group">
    <tr>
    <td>
    <h6>Password: </h6>
    </td>
    <td>
    <input type="password" class="input" name="pass" id="InputPassword1" placeholder="Password">
    </td>
    </tr>
    </table>
  </div>
  <button type="submit" class="btn btn-default">Submit</button><br><br>
  
  </center>
</form>

</div>
<div class="col1">
<center>
<h3>Financial Tool</h3>
<br><br><br>	
<p>Welcome to our online financial tool where you can easily view and modify multiple financial accounts and check your transaction 
history for each account.
</center>
<br><br><br>
New Users: <a href="signup.php">Sign Up Now</a>


</div>
</div>
</div>


</body>
</html>';
?>