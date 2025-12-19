<?php
// db.php

$host = "localhost";
$user = "root";
$password = "";
$dbname = "myporfolio";

// Correct variable name here
$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");
