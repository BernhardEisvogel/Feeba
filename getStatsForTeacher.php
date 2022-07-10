<?php
require 'init.php';

if(isset($_POST['session']))
    {
    $sql = "DELETE FROM sessions WHERE date < CURRENT_TIMESTAMP - INTERVAL 80 SECOND";
    if ($_SESSION['conn']->query($sql) !== TRUE) {
            echo "Error: " . $sql . "<br>" . $_SESSION['conn']->error;
    }
    
    $sessionid = $_POST['session'];
    $sql_fast = "SELECT fast FROM sessions WHERE id ='$sessionid' AND fast = '1'";
    $sql_slow = "SELECT slow FROM sessions WHERE id ='$sessionid' AND slow = '1'";
    $sql_perfect = "SELECT perfect FROM sessions WHERE id ='$sessionid' AND perfect = '1'";
    $result_fast = $_SESSION['conn']->query($sql_fast);
    $result_slow = $_SESSION['conn']->query($sql_slow);
    $result_perfect = $_SESSION['conn']->query($sql_perfect);
    
    $count_perfect = $result_perfect->num_rows;
    $count_fast = $result_fast->num_rows;
    $count_slow = $result_slow->num_rows;
    echo $count_fast . ";".$count_perfect.";" . $count_slow ;
}else{ 
    echo("-1");
}
?>