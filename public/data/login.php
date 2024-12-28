<?php
session_start();

try {
  $bdd = new PDO('mysql:host=localhost;dbname=zoo-arcadia', 'root', '');
  $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $error) {
  echo $error;
}

if (isset($_POST['connected'])) {
  if (!empty($_POST['login']) && !empty($_POST['password'])) {
    $pseudo = htmlspecialchars($_POST['login']);
    $password = md5($_POST['password']);

    $recupUSER = $bdd->prepare('SELECT * FROM users WHERE username = ? AND password = ?');
    $recupUSER->execute(array($pseudo, $password));

    if ($recupUSER->rowCount() > 0) {
      $_SESSION['login'] = $pseudo;
      $_SESSION['password'] = $password;

      if (isset($_SESSION['login'])) {
        $pseudo = $_SESSION['login'];
        echo "<script>alert('Bienvenue, $pseudo !');</script>";
        unset($_SESSION['login_alert']);
      }
      if ($bdd->prepare('SELECT * FROM users WHERE username = Administrateur')) {
        header('Location: espaceAdmin.php');
      }
      if ($bdd->prepare('SELECT * FROM users WHERE username = Veterinaire')) {
        header('Location: espaceVeto.php');
      }
    } else {
      echo "Votre identifiant ou mot de passe est incorrect";
    }
  } else {
    echo "Veuillez indiquer votre email ainsi que votre mot de passe";
  }
}
