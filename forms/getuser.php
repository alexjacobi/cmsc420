<?php
$q = $_GET['q'];

include "../database.php";
$con=mysql_connect($DB_HOST,$DB_USER,$DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error()); $db=mysql_select_db($DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());

$sqloff=mysql_query("SELECT * FROM services WHERE category = '".$q."' and offered = 'Yes'");
$sqlnotoff=mysql_query("SELECT * FROM services WHERE category = '".$q."' and offered = 'No'");
$offered = "<select name='choice[]' id='example-multiple-selected' multiple='multiple'>";
while ($row2 = mysql_fetch_array($sqloff)) {
		    $offered = $offered."<option selected='selected' value='" . $row2['service_type'] . "'>" . $row2['service_type']."</option>";
}

$notoffered = "";
while ($row2 = mysql_fetch_array($sqlnotoff)) {
		    $notoffered = $notoffered."<option value='" . $row2['service_type'] . "'>" . $row2['service_type']."</option>";

}

$notoffered = $notoffered."</select>";
$offered = $offered.$notoffered;	
$return_off['off'] = $offered;
echo $return_off['off'];

?>