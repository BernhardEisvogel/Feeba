<?php
require 'init.php';
// This files stores the student responses in the mySQL database
function stopIfDangerous($input){
    if (strlen($input) != 4){
        echo ("The code had the wrong size");
        die();
    }
    $characters = array("/", "(", ")", ",","$", "*");;

        for ($i = 0; $i < 4; $i++) {
            $allowed = true;
            for($j = 0; $j<count($characters)-1; $j++){
                if ($input[$i] == $characters[$j]){
                    $allowed = false;
                    break;
                }
            }
            if(!$allowed){
                echo ("There was a forbidden character in the code");
                die();
            }
        }
}
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