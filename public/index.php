<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../styles/index.css">
</head>

<body>

</body>

</html>

<?php

require_once "../templates/index.html";

include './data/login.php';

if (isset($_SESSION['login'])) {
  $pseudo = $_SESSION['login'];
  echo "<script>alert('Bienvenue, $pseudo !');</script>";
  unset($_SESSION['login_alert']);
}
