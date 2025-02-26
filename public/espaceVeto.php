<?php
session_start();
require_once "./data/database.php";
if (!$_SESSION['Vétérinaire']) {
  header('Location: accessdenied.html');
}
?>

<!DOCTYPE html
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


  <main>
    <section class="dashboard-veto">
      <div class="habitat">
        <h2>Rapport de l'habitat</h2>
        <table>
          <thead>
            <tr>
              <th>Habitat</th>
              <th>Rapport</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $stmt = $bdd->query("SELECT * FROM habitat");
            // Créer un tableau associatif
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
            ?>
              <tr>
                <td><?= $row['nom'] ?></td>
                <td><?= htmlspecialchars($row['commentaire_habitat']) ?></td>
                <td>
                  <a href="./editHabitat.php?id=<?= $row['habitat_id'] ?>" class="modify">Modifier</a>
                  <a href="./resetComment.php?id=<?= $row['habitat_id'] ?>" class="delete">Supprimer</a>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
      <div class="report-veto">
        <h2>Rapport par animal</h2>
        <table>
          <thead>
            <tr>
              <th>Animal</th>
              <th>Etat</th>
              <th>Nourriture</th>
              <th>Quantité de nourriture</th>
              <th>Date de passage</th>
              <th>Détails</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query = "
            SELECT 
                a.id AS animal_id, 
                a.breed, 
                r.date, 
                r.detail AS rapport_details, 
                r.status, 
                r.food, 
                r.quantity
            FROM animal a
            LEFT JOIN rapport_veterinaire r ON a.id_rapport = r.rapport_veterinaire_id
        ";
            $statement = $bdd->prepare($query);
            $statement->execute();

            while ($line = $statement->fetch(PDO::FETCH_ASSOC)) :
            ?>
              <tr>
                <td><?= htmlspecialchars($line['breed']) ?></td>
                <td><?= htmlspecialchars($line['status'] ?? 'Aucun rapport') ?></td>
                <td><?= htmlspecialchars($line['food'] ?? 'Aucun rapport') ?></td>
                <td><?= htmlspecialchars($line['quantity'] ?? 'Aucun rapport') ?></td>
                <td><?= htmlspecialchars($line['date'] ?? 'Aucun rapport') ?></td>
                <td><?= htmlspecialchars($line['rapport_details'] ?? 'Aucun rapport') ?></td>
                <td>
                  <a href="./addRapport.php?id=<?= $line['animal_id'] ?>" class="add">Ajouter</a>
                </td>
              <?php endwhile; ?>
              </tr>
          </tbody>
        </table>
      </div>
    </section>
  </main>
</body>
<footer>
  <hr class="break-center">
</footer>

</html>