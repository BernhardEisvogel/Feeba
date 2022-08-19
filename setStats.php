<?php
require 'init.php';
// This files stores the student responses in the mySQL database
if(isset($_POST['session'])){
    $sessionId  = cleanCode($_POST['session']);
    if(isset($_POST['speed']))
        {
            $speed = $_POST['speed'];
            $sql = "";
            if ($speed == -1){
                $sql = "INSERT INTO spresp (session, speed) VALUES ('$sessionId', 0)";
            }else if($speed == 0){
                $sql = "INSERT INTO spresp (session, speed) VALUES ('$sessionId', 1)";
            }else{
                $sql = "INSERT INTO spresp (session, speed) VALUES ('$sessionId', 2)";
            }
            if ($_SESSION['conn']->query($sql) !== TRUE) {
                echo "Error: " . $sql . "<br>" . $_SESSION['conn']->error;
            }else{
                echo $speed;
            }
        }
}
?>