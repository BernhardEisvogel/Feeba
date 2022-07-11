<?php
// This file closes a specific session
require 'init.php';

$dbname = $_SESSION['db-name'];
if ($_SESSION['conn']->query("USE $dbname") !== TRUE) {
    echo "Error using database: " . $conn->error;
}
if(isset($_POST['session']))
    {
    $sessionid = cleanCode($_POST['session']);
    $sql = "DELETE FROM sessions WHERE WHERE id ='$sessionid'";
    if ($_SESSION['conn']->query($sql) !== TRUE) {
            echo "Error: " . $sql . "<br>" . $_SESSION['conn']->error;
    }else{
        echo "Session Closed successfully";
    }
}else{ 
    echo("-1");
}
?>