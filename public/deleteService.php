<?php
session_start();
require_once "data/database.php";

$id = $_GET['id'];
if ($id) {
  $stmt = $bdd->prepare('DELETE FROM service WHERE service_id = ?');
  $stmt->execute([$id]);
}

header('Location: espaceAdmin.php');
exit;
