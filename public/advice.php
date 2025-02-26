<?php

// require_once 'vendor/autoload.php';
require_once 'data/NoSQL.php';

if (isset($_POST['advice'])) {
  if (!empty($_POST['pseudo']) && !empty($_POST['opinion'])) {
    $pseudo = $_POST['pseudo'];
    $opinion = $_POST['opinion'];

    $collection = $mongo->selectCollection('zoo-arcadia', 'advice');
    $result = $collection->insertOne([
      'Pseudo' => $pseudo,
      'Avis' => $opinion,
    ]);
  }
}
