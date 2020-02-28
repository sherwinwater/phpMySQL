<?php

$servername = "localhost";
$username = "sam";
$password = "sam";
$conn;
try {
    $conn = new PDO("mysql:host=$servername;dbname=test", $username, $password);
    //set PDO error mode
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
    
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$conn = null;

?>