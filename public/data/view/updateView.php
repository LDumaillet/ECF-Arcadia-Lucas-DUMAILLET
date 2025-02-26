<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "zoo-arcadia");

if (!$mysqli->connect_error && isset($_POST['animal'])) {
  $animal = $mysqli->real_escape_string($_POST['animal']);

  if (!isset($_SESSION[$animal . '_viewed'])) {
    $requete = "UPDATE animal SET view = view + 1 WHERE breed = '$animal'";
    $mysqli->query($requete);
    $_SESSION[$animal . '_viewed'] = true;
  }
}
