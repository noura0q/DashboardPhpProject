<?php
$servername = "localhost";
$username = "root";
$password = "root"; 
$dbname = "SDAIA_Academy_DashboardDB";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);
}

?>
