<?php
$mysqli = new mysqli("localhost", "root", "", "zoo-arcadia");

if (!$mysqli->connect_error && isset($_POST['animal'])) {
  $animal = $mysqli->real_escape_string($_POST['animal']);
  $requete = "SELECT view FROM animal WHERE breed = '$animal'";
  $resultat = $mysqli->query($requete);

  if ($resultat) {
    $ligne = $resultat->fetch_assoc();
    echo json_encode($ligne);
  }
}
