<?php
// This file closes a specific session
require 'init.php';

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

$dbname = $_SESSION['db-name'];
if ($_SESSION['conn']->query("USE $dbname") !== TRUE) {
    echo "Error using database: " . $conn->error;
}
if(isset($_POST['session']))
    {
    stopIfDangerous($_POST['session']);
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