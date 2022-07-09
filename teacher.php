<?php
    require 'init.php';
    function getRandomString($n) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }

    $sessionid = "";

    if (empty($_GET)) {
        $sessionid = "0X19";//;getRandomString(4);
        $sql = "INSERT INTO sessions (id, slow, perfect, fast, solA, solB, solC, solD) VALUES ('$sessionid', 0, 0, 0, 0, 0, 0, 0)";
        if ($_SESSION['conn']->query($sql) !== TRUE) {
            echo "Error: " . $sql . "<br>" . $_SESSION['conn']->error;
        }
        
    }else{
        $sessionid = $_GET["q"];
        $sql = "SELECT slow FROM sessions WHERE id ='$sessionid' ";
        if ($_SESSION['conn']->query($sql) !== TRUE) {
            echo "Error: " . $sql . "<br>" . $_SESSION['conn']->error;
        }
        echo($sql);
    }
?>

<html id="page" class="my_feeba">
<head>
    <link rel="stylesheet" href="styles.css" />
    <script src=
            "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"> </script>
    <script src="qrcode.min.js"> </script>
    <script type="text/javascript">
        const setState = (state) => {
            document.getElementById("page").className = state;
        }
        const code = "<?php echo ($sessionid);?>";
        const getCodeDigitInput = (digit) => {
            return document.getElementById(`digit-${digit}`);
        }
        const setCode = () => {
            const digit = code.split('');
            getCodeDigitInput(1).innerText = digit[0];
            getCodeDigitInput(2).innerText = digit[1];
            getCodeDigitInput(3).innerText = digit[2];
            getCodeDigitInput(4).innerText = digit[3];
        }
    </script>
    <script>
    function updateView(a) {
        const dataArray = a.split(';');
        const fast =  parseInt(dataArray[0]);
        const fine =  parseInt(dataArray[1]);
        const slow =  parseInt(dataArray[2]); 
        
        var all = fast + fine + slow;
        if(all == 0){all = 1;}
        

        const fastPercent = Math.round(fast / all * 100);
        const finePercent = Math.round(fine / all * 100);
        const slowPercent = Math.round(slow / all * 100);

        document.getElementById('chart').style = `
            background: conic-gradient(
                #00ace8 ${fastPercent}%, 
                #78caf2 0 ${fastPercent + finePercent}%,
                #c0e4fa 0
            )`;

        document.getElementById("result_fast").innerText = fast;
        document.getElementById("result_fine").innerText = fine;
        document.getElementById("result_slow").innerText = slow;
    }
    function updateStats() {
             $.post('getStatsForTeacher.php', {
                    session: "<?php echo($sessionid); ?>"
                    }, (response) => {
                        // response from PHP back-end
                        updateView(response, "");
            });
    }
    window.setInterval(updateStats, 2000);
    </script>
</head>
    
<body>
<header>
    <div class="logo">
        <img src="logo.png" />
    </div>
    <div class="center"></div>
    <nav class="menu">
    </nav>
</header>

<main class="content my_feeba">
    <div class="header">
        Dein eigenes feeba
    </div>
    <div class="main">
        <div class="side_code">
            <span class="digit">
                <span class="digit-value" id = "digit-1"></span>
            </span>
            <span class="digit">
                <span class="digit-value" id = "digit-2"></span>
            </span>
            <span class="digit">
                <span class="digit-value" id = "digit-3"></span>
            </span>
            <span class="digit">
                <span class="digit-value" id = "digit-4"></span>
            </span>
        </div>
    </div>
    <div id="feeba_link_qr" data-link="http://elephant.eisvogel.net/feeba/studentMainPage.php?q=<?php echo ($sessionid);?>"></div>
    
    <button onclick="setState('feeba_result')" class="btn">
                Weiter
     </button>
    
    <div class="feeba_link">
        feeba.de/<?php echo ($sessionid);?>
    </div>
    <div class="explanation">
        Lasse deinen Teilnehmern den Code oder Link zukommen, damit sie abstimmen können.
    </div>
</main>

<!-- feeba_result -->
<main class="content feeba_result">
    <div class="stats_wrapper">
        <div id="chart" class="chart"></div>
        <div class="result_list">
            <div>
                <span>
                    <span class="stat_number" id="result_fast"></span> <span>Schülern</span><br/>
                    <span>ist es zu schnell</span>
                </span>
            </div>
            <div>
                <span>
                    <span class="stat_number" id="result_fine"></span> <span>Schülern</span><br/>
                    <span>finden das Tempo genau richtig</span>
                </span>
            </div>
            <div>
                <span>
                    <span class="stat_number" id="result_slow"></span> <span>Schülern</span><br/>
                    <span>langweilen sich</span>
                </span>
            </div>
        </div>
    </div>
</main>
<button onclick="setState('my_feeba')" class="btn">
                Zurück
     </button>
<footer>
    <a href="#" class="impressum">Impressum</a>
</footer>

<script type="text/javascript">
    setCode();

    // initialize qr code
    const element = document.getElementById("feeba_link_qr")
    if (element) {
        const link = element.getAttribute("data-link");
        new QRCode(element, {text: link, colorDark: "#000000"});
    }
</script>

</body>
    
</html>
