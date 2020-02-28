<?php

$servername = "localhost";
$username = "sam";
$password = "sam";
$dbname ="myDBPDO";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    //set PDO error mode
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
    
    // sql to create table
    $sql = "CREATE TABLE IF NOT EXISTS MyGuests (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            firstname VARCHAR(30) NOT NULL,
            lastname VARCHAR(30) NOT NULL,
            email VARCHAR(50),
            reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            
            )";
    //use exec() cause no results returned
    $conn->exec($sql);
    echo "Table MyGuests created sucessfully<br>";
    
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    echo $sql."<br>".$e->getMessage();
}

$conn = null;

?>