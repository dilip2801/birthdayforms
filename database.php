<?php
$hostName="localhost";
$dbUser="root";
$dbPassword="";
$dbName="birthday";
$conn=mysqli_connect($hostName,$dbUser,$dbPassword,$dbName);
if(!$conn)
{
    die("error");
}
// $conn->set_charset('utf8mb4');
?>