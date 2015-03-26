<?php
include "../database.php";
session_start();
$con=mysql_connect($DB_HOST,$DB_USER,$DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error()); $db=mysql_select_db($DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());
$query = mysql_query("SELECT * FROM userTable where email = '$_SESSION[user]' AND password = '$_SESSION[password]'") or die(mysql_error());
$row = mysql_fetch_array($query);
if ($row['email']) {
$assigner = mysql_query("UPDATE jobs SET estimate='$_POST[estimate]', pdf='Yes' WHERE id='$_POST[jobid]'");
$table_query = mysql_query("SELECT job_info FROM jobs where id= '".$_POST[jobid]."'");
$e_query = mysql_query("SELECT * FROM jobs where id= '".$_POST[jobid]."'");
$es = mysql_fetch_array($e_query);
$query_client = mysql_query("SELECT * FROM userTable where first_name = '$es[first_name_client]' AND last_name = '$es[last_name_client]'");
$client_info = mysql_fetch_array($query_client);
$e = array();
$i = 0;
while ($jrow = mysql_fetch_array($table_query)) {
    foreach ($jrow as $key => $value){

        $e = unserialize(base64_decode($value));
    }
    }

date_default_timezone_set('America/New_York');
require('fpdf.php');
$pdf = new FPDF();

$pdf->AddPage();
$pdf->SetFont('Times', '', 12);


        // Logo
        $pdf->Image('logo.jpg',10,6,30);

        // Arial bold 15
        $pdf->SetFont('Arial','B',15);

        // Move to the right
        $pdf->Cell(80);

        // Title
        $pdf->Cell(30,10,'Columbia Printing and Graphics', 'C');

        // Line break
        $pdf->Ln(30);

        $pdf->Write(5, "Name: $client_info[first_name] $client_info[last_name]");
        $pdf->Ln(10);
        $pdf->Write(5, "Company: $client_info[company]");
        $pdf->Ln(10);
        $pdf->Write(5, "Email: $client_info[email]");
        $pdf->Ln(10);
        $pdf->Write(5, "Phone Number: $client_info[phone_number]");
        $pdf->Ln(10);
        $pdf->Write(5, "Address: $client_info[address] $client_info[city] $client_info[state], $client_info[zip_code]");
        $pdf->Ln(10);

foreach ($e as $key => $value) {
    $pdf->Write(5, "$key : $value");
    $pdf->Ln(10);
}
$pdf->Write(5, "Quote : $_POST[estimate]");
$pdf->Output('orders/'.$_POST[jobid].'.pdf', 'F');

mysql_close($con);

header('Location: ../s_r/pendingEstimates.php'); 
}
?>