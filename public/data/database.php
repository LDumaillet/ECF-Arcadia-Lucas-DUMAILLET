<?php

try {
  $bdd = new PDO('mysql:host=localhost;dbname=zoo-arcadia', 'GestionDev', 'Admphp143&');
  $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $error) {
  echo $error;
}
