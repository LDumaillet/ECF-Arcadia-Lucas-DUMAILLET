<?php
session_start();
require_once './data/registration.php';
require_once './data/resultView.php';
if (!$_SESSION['Administrateur']) {
  header('Location: accessdenied.html');
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/public/styles/index.css">
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
    <section class="dashboard-admin">
      <div>
        <h2>Création d'un utilisateur</h2>
        <form method="post">
          <div class="form-inscription">
            <div class="login">
              <label for="login">Identifiant :</label>
              <input type="email" name="login" id="login" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9._-]+\.[a-zA-Z]{2,4}$">
            </div>
            <div class="password">
              <label for="password">Mot de passe :</label>
              <input type="password" name="password" id="password" pattern="/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/">
            </div>
            <div class="role">
              <label for="role">Rôle :</label>
              <select name="role" id="role-select">
                <option value="">--Choisir le rôle--</option>
                <option value="Employé">Employé</option>
                <option value="Vétérinaire">Vétérinaire</option>
              </select>
            </div>
            <div class="submit">
              <input type="submit" name="registration" id="registration" value="Inscription">
            </div>
          </div>
        </form>
      </div>
      <div class="view-animal">
        <h2>Nombre de consultation par animal</h2>
        <table>
          <caption>La vue de vos animaux</caption>
          <thead>
            <tr>
              <th>Animal</th>
              <th>Nombre de vue</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($results as $result) {
              echo "<tr><td>" . $result['breed'] . "</td>";
              echo "<td>" . $result['view'] . "</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
      <div class="report-admin">
        <h2>Rapport par animal</h2>
        <form class="form-selected" method="GET">
          <label for="animal">Filtrer par animal :</label>
          <select name="animal" id="animal">
            <option value="">Tous</option>
            <?php
            $animalQuery = "SELECT DISTINCT id, breed FROM animal";
            $animalStatement = $bdd->prepare($animalQuery);
            $animalStatement->execute();
            while ($animal = $animalStatement->fetch(PDO::FETCH_ASSOC)) {
              $selected = (isset($_GET['animal']) && $_GET['animal'] == $animal['id']) ? "selected" : "";
              echo "<option value='{$animal['id']}' $selected>{$animal['breed']}</option>";
            }
            ?>
          </select>

          <label for="date">Filtrer par date :</label>
          <select name="date">
            <option value="">Toutes</option>
            <?php
            $dates = $bdd->query("SELECT DISTINCT date FROM rapport_veterinaire ORDER BY date DESC");
            while ($date = $dates->fetch(PDO::FETCH_ASSOC)) {
              if (!empty($date['date']) && $date['date'] !== '0000-00-00') {
                $dateObj = DateTime::createFromFormat('Y-m-d', $date['date']);
                $formattedDate = $dateObj ? $dateObj->format('d/m/Y') : 'Format invalide';
              } else {
                $formattedDate = 'Aucune date';
              }

              $selected = (isset($_GET['date']) && $_GET['date'] == $date['date']) ? "selected" : "";
              echo "<option value='{$date['date']}' $selected>$formattedDate</option>";
            }
            ?>
          </select>

          <button type="submit">Filtrer</button>
          <button type="submit" name="reset">Afficher tous</button>
        </form>
        <table>
          <thead>
            <tr>
              <th>Animal</th>
              <th>Rapport</th>
              <th>Date</th>
              <th>Ecrit par</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query = "
            SELECT 
                r.rapport_veterinaire_id, 
                r.date, 
                r.detail, 
                r.written_by, 
                a.name AS animal_name, 
                a.breed AS animal_breed
            FROM rapport_veterinaire r
            LEFT JOIN animal a ON r.id_animal = a.id
            WHERE 1 = 1";

            $params = [];

            // Filtre par animal
            if (!empty($_GET['animal'])) {
              $query .= " AND a.id = :animal";
              $params['animal'] = $_GET['animal'];
            }

            // Filtre par date
            if (!empty($_GET['date'])) {
              $query .= " AND r.date = :date";
              $params['date'] = $_GET['date'];
            }

            // Reintialise la date sélectionnée
            if (isset($_GET['reset'])) {
              $query = "
              SELECT 
                  a.id AS animal_id,
                  a.breed AS animal_breed,
                  a.name AS animal_name,
                  r.rapport_veterinaire_id,
                  r.date,
                  r.detail,
                  r.written_by
              FROM animal a
              LEFT JOIN rapport_veterinaire r ON a.id = r.id_animal";
              $params = [];
            }

            $statement = $bdd->prepare($query);
            $statement->execute($params);


            if ($statement->rowCount() == 0): ?>
              <tr>
                <td></td>
                <td>Aucun rapport trouvé pour cette sélection</td>
                <td></td>
                <td></td>
              </tr>

              <?php else:
              while ($line = $statement->fetch(PDO::FETCH_ASSOC)) :
              ?>
                <tr>
                  <td><?= htmlspecialchars($line['animal_breed']) ?></td>
                  <td><?= htmlspecialchars($line['detail'] ?? 'Aucun rapport') ?></td>
                  <td>
                    <?php
                    if (!empty($line['date']) && $line['date'] !== '0000-00-00') {
                      $dateObj = DateTime::createFromFormat('Y-m-d', $line['date']);
                      echo $dateObj ? htmlspecialchars($dateObj->format('d/m/Y')) : 'Format invalide';
                    } else {
                      echo 'Aucune date';
                    }
                    ?>
                  </td>
                  <td><?= htmlspecialchars($line['written_by'] ?? 'Aucun vétérinaire') ?></td>
                <?php endwhile; ?>
              <?php endif; ?>
                </tr>
          </tbody>
        </table>
      </div>
      <div class="modify-website">
        <h2 class="modify-title">Modification du site</h2>
        <div class="modify-services">
          <h2>Services</h2>
          <div class="view-services">
            <?php
            $stmt = $bdd->prepare("SELECT * FROM service");
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
              <div class="one-service">
                <h4><?= htmlspecialchars($row['nom']) ?></h4>
                <img src=<?= htmlspecialchars($row['image']) ?> alt=<?= htmlspecialchars($row['nom']) ?>>
                <p><?= htmlspecialchars($row['description']) ?></p>
                <div class="link">
                  <a href="./editService.php?id=<?= $row['service_id'] ?>" class="modify">Modifier</a>
                  <a href="./deleteService.php?id=<?= $row['service_id'] ?>" class="delete">Supprimer</a>
                </div>
                <hr>
              </div>
            <?php endwhile; ?>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["picture"])) {
              if (isset($_POST["add-service"])) {
                $name = $_POST["name"];
                $description = $_POST["description"];

                // Vérifier si un fichier a été téléchargé
                if ($_FILES["picture"]["error"] == 0) {
                  $target_dir = "pictures/"; // Chemin RELATIF pour affichage web
                  $upload_dir = __DIR__ . "/" . $target_dir; // Chemin ABSOLU pour stockage

                  // Assurer que le dossier existe
                  if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                  }

                  // Récupérer l'extension du fichier
                  $imageFileType = strtolower(pathinfo($_FILES["picture"]["name"], PATHINFO_EXTENSION));

                  // Vérifier si le fichier est une image
                  $check = getimagesize($_FILES["picture"]["tmp_name"]);
                  if ($check !== false) {
                    $allowed_formats = ["jpg", "jpeg", "png", "gif"];
                    if (in_array($imageFileType, $allowed_formats)) {

                      // Renommer le fichier pour éviter les doublons
                      $newFileName = uniqid() . "." . $imageFileType;
                      $target_file = $upload_dir . $newFileName; // Chemin ABSOLU
                      $relative_path = $target_dir . $newFileName; // Chemin RELATIF pour la base

                      // Déplacer le fichier
                      if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
                        // Insérer les données dans la base avec le chemin relatif
                        $stmt = $bdd->prepare("INSERT INTO service (nom, description, image) VALUES (?, ?, ?)");
                        $stmt->execute([$name, $description, $relative_path]);

                        echo "Service ajouté avec succès !";
                      } else {
                        echo "Erreur lors de l'upload de l'image.";
                      }
                    } else {
                      echo "Seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
                    }
                  } else {
                    echo "Le fichier n'est pas une image.";
                  }
                } else {
                  echo "Erreur lors du téléchargement du fichier.";
                }
              }
            }
            ?>


            <form method="post" enctype="multipart/form-data">
              <div class="add-service">
                <div class="name">
                  <label for="name">Nom :</label>
                  <input type="texte" name="name" id="name">
                </div>
                <div class="description">
                  <label for="description">Description :</label>
                  <input type="text" name="description" id="description">
                </div>
                <div class="picture">
                  <label for="picture">Image :</label>
                  <input type="file" name="picture" id="picture">
                </div>
                <div class="submit">
                  <input class="add-service" type="submit" name="add-service" id="add-service" value="Ajouter un service">
                </div>
              </div>
            </form>
          </div>
        </div>

        <div class="modify-opening">
          <h2>Horaires</h2>
          <?php
          if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (isset($_POST["add-opening"])) {
              ["day" => $day, "start-time" => $startTime, "finish-time" => $finishTime] = $_POST;
              $qry = "INSERT INTO ouverture (day, startTime, finishTime) VALUES ( ?, ?, ?)";
              $stmt = $bdd->prepare($qry);
              $stmt->execute([$day, $startTime, $finishTime]);
              exit;
            }
          }
          ?>
          <form method="post">
            <div class="add-opening">
              <div class="day">
                <label for="day">Jour :</label>
                <input type="texte" name="day" id="day" pattern="[A-Za-z]+">
              </div>
              <div class="start-time">
                <label for="start-time">Heure d'ouverture :</label>
                <input type="number" name="start-time" id="start-time" min="0" max="24">
              </div>
              <div class="finish-time">
                <label for="finish-time">Heure de fermeture :</label>
                <input type="number" name="finish-time" id="finish-time" min="0 " max="24">
              </div>
              <div class="submit">
                <input class="add-opening" type="submit" name="add-opening" id="add-opening" value="Ajouter">
              </div>
            </div>
          </form>
          <table class="table-opening">
            <thead>
              <tr>
                <th>Jour</th>
                <th>Horaire de début</th>
                <th>Horaire de fin</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $stmt = $bdd->query("SELECT * FROM ouverture");
              // Créer un tableau associatif
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
              ?>
                <tr>
                  <td><?= htmlspecialchars($row['day']) ?></td>
                  <td><?= htmlspecialchars($row['startTime']) ?>h</td>
                  <td><?= htmlspecialchars($row['finishTime']) ?>h</td>
                  <td>
                    <a href="./editOpening.php?id=<?= $row['id'] ?>" class="modify">Modifier</a>
                    <a href="./deleteOpening.php?id=<?= $row['id'] ?>" class="delete">Supprimer</a>
                  </td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
        <div class="modify-habitat">
          <h2>Habitat</h2>
        </div>
        <div class="modify-animal">
          <h2>Animaux</h2>
        </div>
      </div>
    </section>
  </main>
  <footer>
    <hr class="break-center">
  </footer>
</body>