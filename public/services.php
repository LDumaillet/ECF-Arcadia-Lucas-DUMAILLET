<?php
session_start();
require_once 'data/database.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles/index.css">
  <link rel="shortcut icon" alt="logo-zoo" href="./pictures/logo-transparent-svg.svg" />
  <script src="/script/displayOnClick.js" defer></script>
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
    </nav>
    <hr class="break-full">
  </header>



  <main>
    <section class="services flux">
      <h2>Nos services</h2>
      <div class="our-services">
        <?php
        $stmt = $bdd->prepare("SELECT * FROM service");
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
          <div>
            <h4><?= htmlspecialchars($row['nom']) ?></h4>
            <img src=<?= htmlspecialchars($row['image']) ?> alt=<?= htmlspecialchars($row['nom']) ?>>
            <p><?= htmlspecialchars($row['description']) ?></p>
          </div>
        <?php endwhile; ?>
      </div>
    </section>
    <div class="opening-hours">
      <h3>Ouverture du zoo</h3>
      <?php
      $stmt = $bdd->prepare("SELECT * FROM ouverture");
      $stmt->execute();
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
        <p><?= htmlspecialchars($row['day']) ?> de <?= htmlspecialchars($row['startTime']) ?>h à <?= htmlspecialchars($row['finishTime']) ?>h</p>
      <?php endwhile; ?>
    </div>
  </main>
  <footer>
    <hr class="break-center">
  </footer>
</body>

</html>