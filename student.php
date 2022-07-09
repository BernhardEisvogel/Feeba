<html class="join_feeba">
<head>
    <link rel="stylesheet" href="styles.css" />
    <script src=
"https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
    </script>
<script>
function login() {
    $.post('studentMainPage.php', {
            session:'DEFR'}, 
                   (response) => {
                console.log(response);
            });
}

const setDigitValue = (digit, value) => {
    if (value === '') {
        return
    }
    const nextDigitElement = getCodeDigitInput(digit + 1);
    if (nextDigitElement) {
        nextDigitElement.focus();
    }
    
    document.getElementById("session").value = getCode();
}

const getCodeDigitInput = (digit) => {
    return document.getElementById(`digit-${digit}`);
}

const getCode = () => {
    return getCodeDigitInput(1).value + getCodeDigitInput(2).value + getCodeDigitInput(3).value + getCodeDigitInput(4).value
}

</script>
</head>
<body>
<header>
    <div class="logo">
        <img src="logo.png" />
    </div>
    <div class="center"></div>
    <nav class="menu">
        <button class="btn create">Eigenes feeba erstellen</button>
        <button class="btn_full join">Einem feeba beitreten</button>
    </nav>
</header>
<main class="content join_feeba">
<form method="post" id="login" action="studentMainPage.php">
    <div class="main">
        <div class="side_code">
            <span class="digit">
                <input oninput="setDigitValue(1, this.value)" id="digit-1" name="digit-1" value="" maxlength="1" />
            </span>
            <span class="digit">
                <input oninput="setDigitValue(2, this.value)" id="digit-2" name="digit-2" value="" maxlength="1" />
            </span>
            <span class="digit">
                <input oninput="setDigitValue(3, this.value)" id="digit-3" name="digit-3" value="" maxlength="1" />
            </span>
            <span class="digit">
                <input oninput="setDigitValue(4, this.value)" id="digit-4" name="digit-4" value="" maxlength="1" />
            </span>
        </div>
    </div>
    <div class="main">
        <input type="hidden" id="session" name="session" />
        <button type="submit" class="btn_full join-survey">
            Feeba beitreten
        </button>
    </div>
</form>
</main>
<footer>
    <a href="#" class="impressum">Impressum</a>
</footer>
</body>
</html>
