<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pec";

// Create connection
$DB = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($DB->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

?>