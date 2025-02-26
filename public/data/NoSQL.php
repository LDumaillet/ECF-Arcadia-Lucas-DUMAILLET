<?php
try {
  // URL de ma base de données
  $uri = 'mongodb://localhost:27017/';
  // Connexion à ma base
  $mongo = new MongoDB\Client($uri);
} catch (PDOException $error) {
  echo $error;
}
