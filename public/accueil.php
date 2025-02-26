<?php
require_once 'advice.php';
require_once 'readAdvice.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./index.css">
  <link rel="shortcut icon" alt="logo-zoo" href="./pictures/logo-transparent-svg.svg" />
  <script src="./script/displayOnClick.js" defer></script>
  <title>Zoo Arcadia</title>
</head>

<body>
  <header>
    <nav>
      <div class="navbar flux">
        <ul>
          <li>
            <img src="./pictures/logo-transparent-svg.svg" alt="logo-zoo-arcadia" class="logo-arcadia">
          </li>
          <li><a href="./accueil.php">
              <img src="./icons/home.svg" alt="icone-home" class="icon-home"></a>
          </li>
          <li id="hamburger">
            <img src="./icons/menu.svg" alt="hamburger-menu">
          </li>
          <li>
            <a href="./services.php">Les services<img src="./icons/arrow-down-drop-circle-black.svg" alt="flèche-bas"
                class="icon-navbar"></a>
          </li>
          <li>
            <a href="./habitat.php">Les habitats<img src="./icons/arrow-down-drop-circle-black.svg" alt="flèche-bas"
                class="icon-navbar"></a>
          </li>
          <li>
            <a href="./connexion.php">Connexion<img src="./icons/account.svg" alt="icone-connexion"
                class="icon-navbar"></a>
          </li>
          <li>
            <a href="./contact.php">Contact <img src="./icons/phone.svg" alt="icone-telephone" class="icon-navbar"></a>
          </li>
        </ul>
      </div>
      <hr class="break-full">
    </nav>
  </header>

  <main>

    <div class="presentation">
      <img src="./pictures/panda.jpg" alt="image-panda">
      <h4>Bienvenue au ZOO Arcadia, situé en France près de la forêt de Brocéliande, en bretagne depuis 1960</h4>
    </div>
    <hr class="break-center">

    <section class="home-global flux">
      <!-- Découverte du zoo et ses avis -->
      <h2 class="flux">Exploration du zoo</h2>
      <div class="container-explore">
        <div>
          <img src="./pictures/habitat-elephant.jpg" alt="image-savane-avec-elephant">
          <h3>Nos habitats</h3>
          <a href="./habitat.php">Je découvre <img src="./icons/arrow-down-drop-circle-white.svg"
              alt="flèche-droite"></a>
        </div>

        <div>
          <img src="./pictures/table-restaurant.jpg" alt="image-restaurant">
          <h3>Nos services</h3>
          <a href="./services.php">Je découvre <img src="./icons/arrow-down-drop-circle-white.svg" alt=""></a>
        </div>

        <div>
          <img src="./pictures/tigre.jpg" alt="image-tigre">
          <h3>Nos animaux</h3>
          <a href="./habitat.php">Je découvre <img src="./icons/arrow-down-drop-circle-white.svg" alt=""></a>
        </div>
      </div>
      <hr class="break-center">

      <h2>Nos avis</h2>
      <div class="advice">
        <?php
        $i = 1;
        foreach ($resultsMultiple as $doc) {
          $displayPseudo = ($doc['Pseudo']);
          $displayAdvice = ($doc['Avis']);
          if ($i <= 6) {
            $i++;
            echo "
            <div class='one-advice'>
            <h5>$displayPseudo</h5>
            <p>$displayAdvice</p>
            </div>";
          }
        }
        ?>
      </div>
    </section>
  </main>

  <section class="your-advice">
    <h3>Votre avis est important</h3>
    <form method="post">
      <div class="advice-user">
        <div>
          <label for="pseudo">Votre pseudo :</label>
          <input type="text" name="pseudo" id="pseudo" required>
        </div>
        <div>
          <label for="opinion" class="opinion"></label>
          <textarea name="opinion" id="opinion" placeholder="Ecrire votre avis :" required minlength="20"></textarea>
        </div>
      </div>
      <div class="submit">
        <input type="submit" name="advice" value="Envoyer">
      </div>
    </form>
  </section>
  <footer>
    <hr class="break-center">
  </footer>

</body>

</html>