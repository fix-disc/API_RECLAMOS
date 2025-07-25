<?php
error_reporting(1);

// DEV
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "libroquejas";

// PROD
$servername = "localhost";
$username = "c1551705_lib_que";
$password = "Apolo011";
$dbname = "c1551705_lib_que";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8mb4");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>