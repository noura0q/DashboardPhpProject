
<?php
$servername = "localhost";
$username = "root";  // Removed the leading space
$password = ""; 
$dbname = "sdaia_academy_dashboarddb";
$port = 3307;

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
