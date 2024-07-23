<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "SDAIA_Academy_DashboardDB";
$port = 3307;
$conn = new mysqli($servername, $username, $password, $dbname,$port);


if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);
}

?>
