<?php
require 'init.php';

if(isset($_POST['session']))
    {
    $sql = "DELETE FROM spresp WHERE date < CURRENT_TIMESTAMP - INTERVAL 80 SECOND";
    if ($_SESSION['conn']->query($sql) !== TRUE) {
            echo "Error: " . $sql . "<br>" . $_SESSION['conn']->error;
    }
    $sessionid = cleanCode($_POST['session']);
    $sql_speed = "SELECT speed FROM spresp WHERE session ='$sessionid'";
    $result_speed = $_SESSION['conn']->query($sql_speed);
    if (!$result_speed) {
    $message  = 'Invalid query: ' . $conn->error . "\n";
    $message = 'Whole query: ' . $query;
    die($message);
    }
    
    $count_perfect = 0;
    $count_fast = 0;
    $count_slow = 0;
    
    while ($value = $result_speed->fetch_row()) {
        if ($value[0] == 0){
            $count_slow= $count_slow + 1;
        } elseif ($value[0] == 1) {
            $count_perfect= $count_perfect + 1;
        } else {
            $count_fast= $count_fast + 1;
        }
    }
    echo $count_fast . ";".$count_perfect.";" . $count_slow ;
}else{ 
    echo("The session id wasn't set!");
}
?>