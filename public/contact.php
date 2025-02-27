<?php require_once 'joining.php'; ?>
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
          <a href="./contact.html">Contact <img src="./icons/phone.svg" alt="icone-telephone" class="icon-navbar"></a>
        </li>
      </ul>
    </div>
  </nav>
  <hr class="break-full">

  <header class="header-contact">
    <h2>Nous contacter</h2>
  </header>

  <main>
    <section>
      <form method="post" class="flux">
        <div class="contact-us">
          <div>
            <label for="title">Titre :</label>
            <input type="text" name="title" id="title" required>
          </div>
          <div>
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" required>
          </div>
          <div>
            <label for="description" class="description"></label>
            <textarea name="description" id="description" placeholder="Description :" required
              minlength="20"></textarea>
          </div>
          <div class="submit">
            <input name="submit" type="submit" id="submit" value="Envoyer">
          </div>
        </div>
      </form>
    </section>
  </main>

  <footer>
    <hr class="break-center">
  </footer>

</body>

</html>