<?php
require 'CONFIG.php';
$servername =   $_SESSION['db-domain'];
$username =     $_SESSION['db-user'];
$password =     $_SESSION['db-pswd'];
$dbname =       $_SESSION['db-name'];
// Create connection
$conn = new mysqli($servername, $username, $password);


// Check connection
if ($conn->connect_error) {
    echo "Could not connect to the SQL Database";
    die("Connection failed: " . $conn->connect_error);
}
/*
 $sql = "DROP DATABASE feebaDB";
if ($conn->query($sql) !== TRUE) {
    echo "Error dropping database: " . $conn->error;
}
*/

if($dbname == ""){
    $dbname = "feebaDB";
    // Check if database exists
    $mysqli = @new mysqli($servername, $username, $password);
    $sql    = "SELECT COUNT(*) AS `exists` FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMATA.SCHEMA_NAME='feebaDB'";
    $query = $mysqli->query($sql);
    $query = $mysqli->query($sql);
    $row = $query->fetch_object();
    $dbExists = (bool) $row->exists;

     if ($dbExists == false){
         $sql = "CREATE DATABASE feebaDB";
         if ($conn->query($sql) !== TRUE) {
             echo "Error creating database: " . $conn->error . "\n";
         }
     }

}
if ($conn->query("USE $dbname") !== TRUE) {
    echo "Error using database: " . $conn->error;
}
/*
$sql = "DROP TABLE sessions";
if ($conn->query($sql) !== TRUE) {
    echo "Error dropping table: " . $conn->error;
}
*/

$result = $conn->query("select * from information_schema.tables where table_name='sessions'");

if($result->num_rows == 0) {
        $table = "CREATE TABLE sessions (
        name INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        id CHAR(4),
        slow SMALLINT UNSIGNED,
        perfect SMALLINT UNSIGNED,
        fast SMALLINT UNSIGNED,
        solA SMALLINT UNSIGNED,
        solB SMALLINT UNSIGNED,
        solC SMALLINT UNSIGNED,
        solD SMALLINT UNSIGNED,
        date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        if ($conn->query($table) !== TRUE) {
          echo "There was an error creating the table". $conn->error;
        }
    
    
}
// Store data for future references;
$_SESSION['db-name'] = $dbname;
$_SESSION['conn'] = $conn;
?>
