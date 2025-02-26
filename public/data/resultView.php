<?php
require_once 'database.php';

$sth = $bdd->prepare("SELECT * FROM animal");
$sth->execute();
$results = $sth->fetchAll();
