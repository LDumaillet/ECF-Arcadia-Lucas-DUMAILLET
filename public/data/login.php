<?php
session_start();
require_once 'database.php';

// Si un utilisateur appuie sur le bouton connexion
if (isset($_POST['connected'])) {
  // Vérifie si les champs identifiants et mot de passe sont entrés
  if (!empty($_POST['login']) && !empty($_POST['password'])) {
    // Je met dans des variables les valeurs indiqués par l'utilisateur
    $email = $_POST['login'];
    // Récupérer l'identifiant de connexion
    $_SESSION['login'] = $email;
    $password = $_POST['password'];
    $role = $_POST['role'];
    // Je fais un requête préparée pour sélectionner dans users mon username ainsi que son role
    $statement = $bdd->prepare('SELECT * FROM users WHERE username = :email AND role = :role');
    // Je récupère un utilisateur ayant le même login
    $statement->bindValue(':email', $email);
    // Je récupère son rôle
    $statement->bindValue(':role', $role);
    // Je crée une session en fonction du rôle
    $_SESSION[$role] = $role;
    // Exécute l'instruction préparée
    $statement->execute();
    // Je renvoie mon user sous forme de tableau associatif
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    // Si les informations de l'utilisateur sont correctement rentrées, il va vérifier le hashage du mot de passe
    if ($user) {
      // On met notre mot de passe qui est dans la base de données dans une variable
      $passwordHash = $user['password'];
      // On compare si le mot de passe inscrit par l'utilisateur et celui sur la base de données sont identiques
      if (password_verify($password, $passwordHash)) {
        // On redirige notre utilisateur dans son espace de travail
        if ($_SESSION['Administrateur']) {
          header('Location: espaceAdmin.php');
        } else if ($_SESSION['Vétérinaire']) {
          header('Location: espaceVeto.php');
        } else if ($_SESSION['Employé']) {
          header('Location: espaceEmploye.php');
        }
      } else {
        echo "<p style='color:red; margin: 0 auto; font-size:36px'>" . "Identifiants invalides" . "</p>";
      }
    } else {
      echo "<p style='color:red; margin: 0 auto; font-size:36px'>" . "Identifiants ou rôle invalides" . "</p>";
    }
  }
}
