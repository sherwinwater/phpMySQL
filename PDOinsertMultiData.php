<?php

$servername = "localhost";
$username = "sam";
$password = "sam";
$dbname = "myDBPDO";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    //set PDO error mode
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully<br>";

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

    // insert data
    $conn->beginTransaction();
    
    $conn->exec("INSERT INTO MyGuests(firstname,lastname,email)VALUES('Mary','Moe','mary@example.com')");
    $conn->exec("INSERT INTO MyGuests(firstname,lastname,email)VALUES('Julie','Doeley','julie@example.com')");
    
    $conn->commit();
    echo "New records created successfully";
    
} catch (PDOException $e) {
    // roll back the transaction if something failed
    $conn->rollBack();
    echo 'error: '.$e->getMessage();
}

$conn = null;
?>