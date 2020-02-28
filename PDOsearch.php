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

    // prepare sql to search
    $stmt = $conn->prepare("SELECT * FROM MyGuests;");
    $execOk = $stmt->execute();
    if($execOk){
        echo "search successfully";
    } else {
      echo "<p>An error has occurred executing your request.  "
        . "Please contact the site administrator.</p>";
    }
    
} catch (PDOException $e) {
    
     echo 'error: ' . $e->getMessage();
}

$conn = null;
?>