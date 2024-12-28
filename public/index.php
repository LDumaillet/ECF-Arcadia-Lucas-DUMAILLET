<?php

require_once "./templates/index.html";

include './data/login.php';

if (isset($_SESSION['login'])) {
  $pseudo = $_SESSION['login'];
  echo "<script>alert('Bienvenue, $pseudo !');</script>";
  unset($_SESSION['login_alert']);
}
