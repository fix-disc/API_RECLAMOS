<?php
error_reporting(E_ALL);

// DEV
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sis-rec";

// PROD
$servername = "localhost";
$username = "c1551705_gestor";
$password = "Apolo011";
$dbname = "c1551705_gestor";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>