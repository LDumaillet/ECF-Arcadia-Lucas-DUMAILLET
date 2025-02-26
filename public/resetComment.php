<?php
session_start();
require_once './data/database.php';
$id = $_GET['id'];
if (!$_SESSION['Vétérinaire']) {
  header('Location: accessdenied.html');
}
if (!$id) {
  header('Location: espaceVeto.php');
  exit;
}
// Nous insérons une valeur NULL à notre commentaire pour vider les données anciennes insérées
$stmt = $bdd->prepare("UPDATE habitat SET commentaire_habitat = NULL WHERE habitat_id = ?");
$stmt->execute([$id]);
header('Location: espaceVeto.php');
exit;
