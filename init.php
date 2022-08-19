<?php
require 'CONFIG.php';
$servername =   $_SESSION['db-domain'];
$username =     $_SESSION['db-user'];
$password =     $_SESSION['db-pswd'];
$dbname =       $_SESSION['db-name'];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if($dbname == ""){
    echo("You have to specify the name of the databse");
    die();
}else if($servername = ""){
    echo("You have to sepecify the mysqli server name");
    die();
}else if($password = ""){
    echo("You have to sepecify the password for the database");
    die();
}else if($username = ""){
    echo("You have to sepecify the user name for the database");
    die();
}

// Check connection
if ($conn->connect_error) {
    echo "Could not connect to the SQL Database";
    die("Connection failed: " . $conn->connect_error);
}


if ($conn->query("USE $dbname") !== TRUE) {
    echo "Error using database: " . $conn->error;
}

$result_sessions = $conn->query("select * from information_schema.tables where table_name='sessions'");
$result_spresp = $conn->query("select * from information_schema.tables where table_name='spresp'");
$result_quresp = $conn->query("select * from information_schema.tables where table_name='quresp'");

/*
$sql = "DROP TABLE sessions";
if ($conn->query($sql) !== TRUE) {
    echo "Error dropping table: " . $conn->error;
}
$sql = "DROP TABLE spresp";
if ($conn->query($sql) !== TRUE) {
    echo "Error dropping table: " . $conn->error;
}
$sql = "DROP TABLE quresp";
if ($conn->query($sql) !== TRUE) {
    echo "Error dropping table: " . $conn->error;
}
*/

// Create tables if they don't exist
if($result_sessions->num_rows == 0) {
        $table = "CREATE TABLE sessions (
        name INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        id CHAR(4),
        mode SMALLINT UNSIGNED,
        date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        if ($conn->query($table) !== TRUE) {
          echo "There was an error creating the table". $conn->error;
        }
    
    
}
if($result_spresp->num_rows == 0) {
        $table = "CREATE TABLE spresp (
        name INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        session CHAR(4),
        speed SMALLINT,
        date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        if ($conn->query($table) !== TRUE) {
          echo "There was an error creating the table". $conn->error;
        }
    
    
}
if($result_quresp->num_rows == 0) {
        $table = "CREATE TABLE quresp (
        name INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        session CHAR(4),
        answer SMALLINT UNSIGNED,
        date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        if ($conn->query($table) !== TRUE) {
          echo "There was an error creating the table". $conn->error;
        }
    
    
}
// Store data for future references;
$_SESSION['db-name'] = $dbname;
$_SESSION['conn'] = $conn;

// This is the barrier that every input has to pass before it is inserted in the mysql search.
function cleanCode($name){
    if (get_magic_quotes_gpc()) {
        $name = stripslashes($name);
    }
    $name = mysqli_real_escape_string($_SESSION['conn'], $name);
    if (strlen($name) != 4) {
        echo("The input didn't have the correct length");
        die();
    }
    return $name;
}

?>
