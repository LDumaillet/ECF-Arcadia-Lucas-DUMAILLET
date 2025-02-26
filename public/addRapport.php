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

$query = "SELECT * FROM animal WHERE id = :id";
$statement = $bdd->prepare($query);
$statement->bindParam(':id', $id, PDO::PARAM_INT);
$statement->execute();
$animal = $statement->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  ["breed" => $breed, "status" => $status, "food" => $food, "quantity" => $quantity, "rapport" => $rapport, "written" => $written] = $_POST;
  $qry = "INSERT INTO rapport_veterinaire (id_animal, status, food, quantity, detail, written_by) VALUES ( ?, ?, ?, ?, ?, ?)";
  $stmt = $bdd->prepare($qry);
  $stmt->execute([$id, $status, $food, $quantity, $rapport, $written]);
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
    <div class="edit-animal">
      <h2>Ajouter un rapport pour <?= htmlspecialchars($animal['name']) ?></h2>
      <form method="POST">
        <div>
          <label for="breed" class="form-label">Animal</label>
          <!-- On récupère grâce à notre tableau associatif le nom de l'animal -->
          <!-- Je met readonly pour refuser la modification de la valeur -->
          <input type="text" class="form-control" value="<?= htmlspecialchars($animal['breed']) ?>" id="breed" name="breed" required readonly>
        </div>
        <div>
          <label for="status" class="form-label">Etat</label>
          <!-- On récupère grâce à notre tableau associatif le nom de l'animal -->
          <!-- Je met readonly pour refuser la modification de la valeur -->
          <input type="text" class="form-control" id="status" name="status" required>
        </div>
        <div>
          <label for="food" class="form-label">Nourritute</label>
          <!-- On récupère grâce à notre tableau associatif le nom de l'animal -->
          <!-- Je met readonly pour refuser la modification de la valeur -->
          <input type="text" class="form-control" id="food" name="food" required>
        </div>
        <div>
          <label for="quantity" class="form-label">Quantité en grammes</label>
          <!-- On récupère grâce à notre tableau associatif le nom de l'animal -->
          <!-- Je met readonly pour refuser la modification de la valeur -->
          <input type="text" class="form-control" id="quantity" name="quantity" required>
        </div>
        <div>
          <label for="rapport" class="form-label">Rapport</label>
          <!-- On insère notre rapport -->
          <textarea class="form-control" id="rapport" name="rapport" required minlength="10"></textarea>
        </div>
        <div>
          <label for="written" class="form-label">Ecrit par</label>
          <!-- On récupère également l'auteur du rapport grâce à 'lidentifiant de session -->
          <input class="form-control" value="<?= htmlspecialchars($_SESSION['login']) ?>" id="written" name="written" required readonly>
        </div>
        <div>
          <button type="submit">Ajouter</button>
        </div>
      </form>
    </div>
  </body>
  <footer>
    <hr class="break-center">
  </footer>

</html>