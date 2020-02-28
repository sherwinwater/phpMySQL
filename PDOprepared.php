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

    // prepare sql and bind para
    $stmt = $conn->prepare("INSERT INTO MyGuests(firstname,lastname,email) VALUES(:firstname,:lastname,:email)");
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':email', $email);

    // insert one row
    $firstname = "andy";
    $lastname = "Wong";
    $email = "andy.wong@gmail.com";
    $stmt->execute();


    // insert another one
    $firstname = "andy2";
    $lastname = "Wong2";
    $email = "andy2.wong@gmail.com";
    $stmt->execute();
   
    echo "New records created successfully";
} catch (PDOException $e) {
    
     echo 'error: ' . $e->getMessage();
}

$conn = null;
?>