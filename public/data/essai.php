
<?php
require_once 'database.php';
$bdd->exec("UPDATE animal SET view = view + 1 WHERE breed = 'Tigre'");
