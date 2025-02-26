<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;


require_once "includes/phpmailer/Exception.php";
require_once "includes/phpmailer/PHPMailer.php";
require_once "includes/phpmailer/SMTP.php";

if (isset($_POST['registration'])) {
  if (!empty($_POST['login']) && !empty($_POST['password'] && !empty($_POST['role']))) {

    $email = $_POST['login'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    require_once 'database.php';
    $statement = $bdd->prepare('INSERT INTO users(username, password, role) VALUES (:username, :password, :role)');
    $statement->bindValue(':username', $email);
    $statement->bindValue(':password', $password);
    $statement->bindValue(':role', $role);

    // Hash du mot de passe en utilisant BCRYPT
    $statement->bindValue(':password', password_hash($_POST['password'], PASSWORD_BCRYPT));
    if ($statement->execute()) {

      $mail = new PHPMailer(true);

      try {
        // Configuration
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        //Je veux des infos de débug

        //On configure le SMTP
        $mail->isSMTP();
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->Username = 'l911dum@gmail.com';
        $mail->Password = 'icgw epif ujql bhlo';
        // CharSet
        $mail->CharSet = "utf-8";

        // Destinataires
        $mail->addAddress($email);
        $mail->addCC('l911dum@gmail.com');

        // Expéditeur
        $mail->setFrom('l911dum@gmail.com');

        // Contenu
        $mail->Subject = "Récupération de votre mot de passe Arcadia";
        $mail->Body =
          "
        <h1>Bienvenue dans nos collaborateurs</h1>
        <br>
        <p>Votre identifiant est : <strong>$email</strong></p>
        <br>
        <p>Vous avez accès à l'espace de travail <strong>$role</strong></p>
        <br>
        <p>Pour obtenir votre mot de passe, veuillez vous retourner auprès de votre administrateur</p>
        <br>
        <p>En vous souhaitant bonne réception</p>
        ";

        $mail->AltBody = "Bienvenue dans nos collaborateurs. Votre mot de passe est $password. Vous avez accès à l'espace de travail $role. En vous souhaitant bonne réception";

        // Envoyer
        $mail->send();
        // echo "Message envoyé";
      } catch (Exception) {
        echo "Message non envoyé. Erreur: {$mail->ErrorInfo}";
      }
      echo "<script>alert('L'utilisateur à bien été créé !');</script>";
    } else {
      echo 'Impossible de créer l\'utilisateur';
    }
  }
}
