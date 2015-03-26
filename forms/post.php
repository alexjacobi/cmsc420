<?php
include "../database.php";
$con=mysql_connect($DB_HOST,$DB_USER,$DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error()); $db=mysql_select_db($DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());
if (empty($_SESSION['user'])) {
$_SESSION['user'] = $_POST['user'];
$_SESSION['password'] = $_POST['pass'];
}

$offered = "";
$i = 0;
        foreach($_POST['choice'] as $result) {
            //
            //$assigner = mysql_query("UPDATE services SET offered='Yes' WHERE service_type='$result'");
            if ($i == sizeof($_POST['choice'])-1) {
                $offered = $offered ."'".$result."'";
            }
            else {
        $offered = $offered ."'".$result."', ";
            }
    $i = $i + 1;
}
$assigner = mysql_query("UPDATE services SET offered='Yes' WHERE service_type in (".$offered.")");
$not_assigner = mysql_query("UPDATE services SET offered='No' WHERE service_type not in (".$offered.") and category='".$_POST['category']."'");
header('Location: ../start_setup.php'); 
?>
