<?php
require 'init.php';
// This files stores the student responses in the mySQL database
if(isset($_POST['session'])){
    stopIfDangerous($_POST['session']);
    $sessionId = $_POST['session'];

    if(isset($_POST['speed']))
        {
            $speed = $_POST['speed'];
            $sql = "";
            if ($speed == -1){
                $sql = "INSERT INTO sessions (id, slow, perfect, fast, solA, solB, solC, solD) VALUES ('$sessionId', 1, 0, 0, 0, 0, 0, 0)";
            }else if($speed == 0){
                $sql = "INSERT INTO sessions (id, slow, perfect, fast, solA, solB, solC, solD) VALUES ('$sessionId', 0, 1, 0, 0, 0, 0, 0)";
            }else{
                $sql = "INSERT INTO sessions (id, slow, perfect, fast, solA, solB, solC, solD) VALUES ('$sessionId', 0, 0, 1, 0, 0, 0, 0)";
            }
            if ($_SESSION['conn']->query($sql) !== TRUE) {
                echo "Error: " . $sql . "<br>" . $_SESSION['conn']->error;
            }
        }
}
?>