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
          <li><a href="/public/index.php">
              <img src="/icons/home.svg" alt="icone-home" class="icon-home"></a>
          </li>
          <li id="hamburger">
            <img src="/icons/menu.svg" alt="hamburger-menu">
          </li>
          <li>
            <a href="/public/services.php">Les services<img src="/icons/arrow-down-drop-circle-black.svg" alt="flèche-bas"
                class="icon-navbar"></a>
          </li>
          <li>
            <a href="/public/habitat.php">Les habitats<img src="/icons/arrow-down-drop-circle-black.svg" alt="flèche-bas"
                class="icon-navbar"></a>
          </li>
          <li>
            <a href="/public/connexion.php">Connexion<img src="/icons/account.svg" alt="icone-connexion"
                class="icon-navbar"></a>
          </li>
          <li>
            <a href="/public/contact.php">Contact <img src="/icons/phone.svg" alt="icone-telephone" class="icon-navbar"></a>
          </li>
        </ul>
      </div>
    </nav>
    <hr class="break-full">
  </header>

  <main>
    <section class="services flux">
      <h2>Nos services</h2>
      <div class="our-services">
        <div>
          <h4>Restauration</h4>
          <img src="/pictures/table-restaurant.jpg" alt="table-du-restaurant">
          <p>Des menus et des plats pour tous les goûts</p>
        </div>
        <div>
          <h4>Visite guidée</h4>
          <img src="/pictures/guide.jpg" alt="carte-avec-loupe">
          <p>Une visite guidée pour connaitre les détails de notre zoo <br>
            <strong>(Gratuit)</strong>
          </p>
        </div>
        <div>
          <h4>Visite en petit train</h4>
          <img src="/pictures/train.jpg" alt="train-touristique">
          <p>Une visite plus reposante avec notre petit train</p>
        </div>
      </div>
    </section>
  </main>

  <footer>
    <hr class="break-center">
  </footer>
</body>

</html>