<?php
$servername = "localhost";
$username = "root";
$password = "";  // Default sa XAMPP
$dbname = "kdstudio";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional: set charset to avoid charset issues
$conn->set_charset("utf8mb4");
?>
