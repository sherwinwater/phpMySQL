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
    
    
    $sql = "CREATE DATABASE IF NOT EXISTS myDBPDO";
    //use exec() cause no results returned
    $conn->exec($sql);
    echo "Database created sucessfully<br>";
    
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    echo $sql."<br>".$e->getMessage();
}

$conn = null;

?>