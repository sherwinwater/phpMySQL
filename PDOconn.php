<?php

/**
 * Testing PDO MySQL Database Connection, query() and exec().
 * For CREATE TABLE, INSERT, DELETE, UPDATE:
 *   exec(): returns the affected rows.
 * For SELECT:
 *   query(): returns a result set.
 */
// Define the MySQL database parameters.
// Avoid global variables (which live longer than necessary) for sensitive data.
$DB_HOST = 'localhost'; // MySQL server hostname
$DB_PORT = '3306';      // MySQL server port number (default 3306)
$DB_NAME = 'test';      // MySQL database name
$DB_USER = 'sam';  // MySQL username
$DB_PASS = 'sam';      // password

try {
    // Create a PDO database connection to MySQL server, in the following syntax:
    //  new PDO('mysql:host=hostname;port=number;dbname=database', username, password)
    $dbConn = new PDO("mysql:host=$DB_HOST;port=$DB_PORT;dbname=$DB_NAME", $DB_USER, $DB_PASS);
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error mode to exception
    echo 'Connected', '<br />';

    // Run SQL statements
    // Use exec() to run a CREATE TABLE, DROP TABLE, INSERT, DELETE and UPDATE,
    //  which returns the affected row count.
    $rowCount = $dbConn->exec('DROP TABLE IF EXISTS `test`');
    echo 'DROP TABLE: ', $rowCount, ' rows', '<br />';

    $rowCount = $dbConn->exec(
            'CREATE TABLE IF NOT EXISTS `test` (
           `id` INT AUTO_INCREMENT,
           `name` VARCHAR(20),
           PRIMARY KEY (`id`))');
    echo 'CREATE TABLE: ', $rowCount, ' rows', '<br />';

    $rowCount = $dbConn->exec("INSERT INTO `test` (`id`, `name`) VALUES (1001, 'peter')");
    echo 'INSERT INTO: ', $rowCount, ' rows', '<br />';
    // Use lastInsertId() to get the LAST_INSERT_ID of the AUTO_INCREMENT column.
    echo 'LAST_INSERT_ID (of the AUTO_INCREMENT column) is ', $dbConn->lastInsertId(), '<br />';

    $rowCount = $dbConn->exec("INSERT INTO `test` (`name`) VALUES ('paul'),('patrick')");
    echo 'INSERT INTO: ', $rowCount, ' rows', '<br />';
    echo 'LAST_INSERT_ID (of the AUTO_INCREMENT column) is ', $dbConn->lastInsertId(), '<br /><br />';

    // Use query() to run a SELECT, which returns a resultset.
    $sql = 'SELECT * FROM `test`';
    $resultset = $dbConn->query($sql);
    // By default, resultset's row is an associative array
    //  indexed by BOTH column-name AND column-number (starting at 0).
    foreach ($resultset as $row) {  // Loop thru all rows in resultset
        echo 'Retrieve via column name: id=', $row['id'], ', name=', $row['name'], '<br />';
        echo 'Retrieve via column number: id=', $row[0], ', name=', $row[1], '<br />';
        print_r($row); // for showing the contents of resultset's row
        echo '<br />';
    }
    echo '<br />';

    // Run again with "FETCH_ASSOC" option.
    // Resultset's row is an associative array indexed by column-name only.
    $resultset = $dbConn->query($sql, PDO::FETCH_ASSOC);
    // print_r($resultset);   // A PDOStatement Object
    foreach ($resultset as $row) {
        echo 'Retrieve via column name: id=', $row['id'], ', name=', $row['name'], '<br />';
        print_r($row); // for showing the contents of resultset's row
        echo '<br />';
    }
    echo '<br />';

    // Run again with "FETCH_OBJ" option.
    // Resultset's row is an object with column-names as properties.
    $resultset = $dbConn->query($sql, PDO::FETCH_OBJ);
    foreach ($resultset as $row) {
        echo 'Retrieve via column name: id=', $row->id, ', name=', $row->name, '<br />';
        print_r($row); // for showing the contents of resultset's row
        echo '<br />';
    }

    // Close the database connection (optional).
    $dbConn = NULL;
} catch (PDOException $e) {
    $fileName = basename($e->getFile(), ".php"); // Filename that trigger the exception
    $lineNumber = $e->getLine();         // Line number that triggers the exception
    die("[$fileName][$lineNumber] Database error: " . $e->getMessage() . '<br />');
}
?>