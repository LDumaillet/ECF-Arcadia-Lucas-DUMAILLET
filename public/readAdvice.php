<?php
require_once 'vendor/autoload.php';
require_once 'data/NoSQL.php';

$collection = $mongo->selectCollection('zoo-arcadia', 'advice');
$resultsMultiple = $collection->find([]);
