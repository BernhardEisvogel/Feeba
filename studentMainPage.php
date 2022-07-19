<?php
// This is the main page for the student. They can vote on the lesson speed.
require 'init.php';
$sessionId = "";
if (!empty($_GET)) {
        $sessionId = $_GET["q"];
    }else{
       if(isset($_POST['session'])){
            $sessionId = $_POST['session'];
       }
    }

if(isset($_POST['session']))
    {
    $sql = "SELECT fast FROM sessions WHERE id ='$sessionId'";
    $result = $_SESSION['conn']->query($sql);
    $count = $result->num_rows;
    if ($count == 0){
        header('Location: feeba404.html');
    }
}else{ 
    echo("The session number wasn't specified!!");
}
?>


<html class="feeba_survey">
<head>
    <title>Echtzeit Klassen Feedback</title>
    <link rel="stylesheet" href="styles.css" />
    <!-- jQuery Ajax CDN -->
    <script src=
            "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
    </script>
    <script>
        function speed(code){
            alert("Vielen Dank für die Rückmeldung!");
            $.post('setStats.php', {
            speed: code,
            session:"<?php echo($sessionId); ?>"}, 
                   (response) => {
                console.log(response);
            });
        }
</script>
</head>
<body>

<header>
    <div class="logo">
        <img src="logo.png" />
    </div>
</header>
<main class="content feeba_survey">
    <div class="header">
        Wie ist die Unterrichtsgeschwindigkeit für dich?
    </div>
    <div class="main">
    <div class="survey">
            <button onclick="speed(1)" class="btn vote">
                <div id="button_container">
                    <div id="button_img_wrap">
                        <img src="icons/rabbit.png" width="30" height="30" />
                    </div>
                    <div id="button_text_wrap">
                        zu schnell
                    </div>
                </div>
            </button>
            <button onclick="speed(0)" class="btn vote">
                <div id="button_container">
                    <div id="button_img_wrap">
                        <img src="icons/smiley.png" width="30" height="30" />
                    </div>
                    <div id="button_text_wrap">
                        genau richtig
                    </div>
                </div>
            </button>
            <button onclick="speed(-1)" class="btn vote">
                <div id="button_container">
                    <div id="button_img_wrap">
                        <img src="icons/snail.png" width="45" height="30" />
                    </div>
                    <div id="button_text_wrap">
                        zu langsam
                    </div>
                </div>
            </button>
        </div>
    </div>
</main>
<footer>
    <a href="impressum.html" class="impressum">Impressum</a>
</footer>
</body>
</html>
