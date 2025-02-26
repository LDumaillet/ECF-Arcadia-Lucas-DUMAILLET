<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;


require_once "data/includes/phpmailer/Exception.php";
require_once "data/includes/phpmailer/PHPMailer.php";
require_once "data/includes/phpmailer/SMTP.php";

require_once 'vendor/autoload.php';
require_once 'data/NoSQL.php';


if (isset($_POST['submit'])) {
  if (!empty($_POST['title']) && !empty($_POST['email'] && !empty($_POST['description']))) {

    $title = $_POST['title'];
    $email = $_POST['email'];
    $description = $_POST['description'];

    $collection = $mongo->selectCollection('zoo-arcadia', 'contact');
    $result = $collection->insertOne([
      'Titre' => $title,
      'Email' => $email,
      'Description' => $description,
    ]);

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
      $mail->addAddress('l911dum@gmail.com');
      $mail->addCC($email);

      // Expéditeur
      $mail->setFrom('l911dum@gmail.com');

      // Contenu
      $mail->Subject = $title;
      $mail->Body = $description;

      $mail->AltBody = $description;

      // Envoyer
      $mail->send();
      // echo "Message envoyé";
    } catch (Exception) {
      echo "Message non envoyé. Erreur: {$mail->ErrorInfo}";
    }
  }
}
