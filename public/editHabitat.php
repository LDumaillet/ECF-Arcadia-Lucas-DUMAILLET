<?php
session_start();
require_once './data/database.php';
// On récupère notre variable HTTP GET
$id = $_GET['id'];
// Si la session n'est pas celle du vétérinaire, on refuse l'accès
if (!$_SESSION['Vétérinaire']) {
  header('Location: accessdenied.html');
}
// Si on ne trouve aucun id dans notre variable, je renvoie l'utilisateur à son espace
if (!$id) {
  header('Location: espaceVeto.php');
  exit;
}

// On séléctionne notre habitat grâce à l'id récupérer
$stmt = $bdd->prepare("SELECT * FROM habitat WHERE habitat_id = ?");
$stmt->execute([$id]);
// Je crée un tableau associatif
$habitat = $stmt->fetch(PDO::FETCH_ASSOC);

// Si nous n'avons aucune habitat, on renvoie l'utilisateur à son espace
if (!$habitat) {
  header('Location: espaceVeto.php');
  exit;
}

// Si on retrouve une méthode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Alors on stocke nos valeurs dans des variables
  ['name' => $name, 'description' => $description] = $_POST;
  // On modifie les valeurs qu'il y a dans notre commentaire_habitat en insérant la variable description et identifiant grâce à son id
  $stmt = $bdd->prepare("UPDATE habitat SET commentaire_habitat = ? WHERE habitat_id = ?");
  $stmt->execute([$description, $id]);
  header('Location: espaceVeto.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../public/styles/index.css">
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
    </nav>
    <hr class="break-full">
  </header>

  <body>
    <div class="edit-habitat">
      <h2>Modifier le rapport de l'habitat</h2>
      <form method="POST">
        <div>
          <label for="name">Habitat</label>
          <!-- On récupère grâce à notre tableau associatif le nom de l'habitat -->
          <!-- Je met readonly pour refuser la modification de la valeur -->
          <input type="text" value="<?= htmlspecialchars($habitat['nom']) ?>" id="name" name="name" required readonly>
        </div>
        <div>
          <label for="description">Description</label>
          <!-- On récupère également la description -->
          <textarea id="description" name="description" required minlength="10"><?= htmlspecialchars($habitat['commentaire_habitat']) ?></textarea>
        </div>
        <div>
          <button type="submit">Modifier</button>
        </div>
      </form>
    </div>
  </body>
  <footer>
    <hr class="break-center">
  </footer>

</html>