<?php
session_start();
$_SESSION = [];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/public/styles/index.css">
  <script src="/public/script/close.js" defer></script>
  <title>Document</title>
</head>

<body>
  <main class="pop-up">
    <div class="alert-pop-up">
      <h1>Vous avez été déconnecté(e)</h1>
      <div>
        <button class="close">Fermer</button>
      </div>
    </div>
  </main>
</body>

</html>