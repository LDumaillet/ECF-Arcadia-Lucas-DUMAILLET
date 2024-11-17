<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/styles/index.css">
  <link rel="shortcut icon" alt="logo-zoo" href="/pictures/logo-transparent-svg.svg"/>
  <script src="/script/displayOnClick.js" defer></script>
  <title>Zoo Arcadia</title>
</head>


<body>
  <header>
    <nav>
      <div class="navbar flux">
        <ul>
          <li>
            <img src="/pictures/logo-transparent-svg.svg" alt="logo-zoo-arcadia" class="logo-arcadia">
          </li>
          <li><a href="pages/accueil.php">
              <img src="/icons/home.svg" alt="icone-home" class="icon-home"></a>
          </li>
          <li id="hamburger">
            <img src="/icons/menu.svg" alt="hamburger-menu">
          </li>
          <li>
            <a href="services.php">Les services<img src="/icons/arrow-down-drop-circle-black.svg" alt="flèche-bas"
                class="icon-navbar"></a>
          </li>
          <li>
            <a href="habitat.php">Les habitats<img src="/icons/arrow-down-drop-circle-black.svg" alt="flèche-bas"
                class="icon-navbar"></a>
          </li>
          <li>
            <a href="connexion.php">Connexion<img src="/icons/account.svg" alt="icone-connexion"
                class="icon-navbar"></a>
          </li>
          <li>
            <a href="contact.php">Contact <img src="/icons/phone.svg" alt="icone-telephone" class="icon-navbar"></a>
          </li>
        </ul>
      </div>
    </nav>
    <hr class="break-full">
  </header>

  <main>
    <section class="connection flux">
      <h2>Connexion</h2>
      <form method="post">
        <div class="form-connection">
          <div class="login">
            <label for="login">Votre identifiant :</label>
            <input type="text" name="login" id="login" required>
          </div>
          <div class="password">
            <label for="password">Votre mot de passe :</label>
            <input type="password" name="password" id="password" required>
          </div>
          <div class="submit">
            <input type="submit" name="connected" id="connected" value="Se connecter">
          </div>
        </div>
      </form>
    </section>
  </main>

<?php
 include 'data/login.php';
?>

  <footer>
    <hr class="break-center">
  </footer>
</body>

</html>