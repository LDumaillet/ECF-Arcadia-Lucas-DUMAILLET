<?php
session_start();
require_once './data/database.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./index.css">
  <link rel="shortcut icon" alt="logo-zoo" href="./pictures/logo-transparent-svg.svg" />
  <script src="./script/displayOnClick.js" defer></script>
  <script src="script/view.js" defer></script>
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
            <a href="./habitat.html">Les habitats<img src="./icons/arrow-down-drop-circle-black.svg" alt="flèche-bas"
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
    <section class="habitats flux">
      <h2>Nos habitats</h2>
      <div class="our-habitats">
        <div class="savannah">
          <h4 id="click-savannah">La savane</h4>
          <p>La savane est une formation végétale propre aux régions chaudes à longue saison sèche et dominée par les
            plantes herbacées de la famille des Poacées. Elle est plus ou moins parsemée d'arbres ou d'arbustes</p>
          <h5>Les animaux de la savane sont :</h5>
          <?php
          $query = "
            SELECT 
                a.id AS animal_id, 
                a.breed, 
                a.name,
                a.image,
                r.date,
                r.detail AS rapport_details, 
                r.status, 
                r.food, 
                r.quantity
            FROM animal a
            LEFT JOIN rapport_veterinaire r ON a.id_rapport = r.rapport_veterinaire_id
            WHERE a.id = 1
        ";
          $statement = $bdd->prepare($query);
          $statement->execute();

          while ($row = $statement->fetch(PDO::FETCH_ASSOC)) :
          ?>
            <div class="tiger">
              <button onclick="incrementeView('Tigre')">
                <h6><?= $row["breed"] ?> <img src="./icons/arrow-right.svg" alt="flèche-vers-la-droite" class="arrow-right"> <img
                    src="./icons/arrow-down.svg" alt="flèche-vers-le-bas" class="arrow-down">
                </h6>
              </button>
              <div class="card-tiger">
                <div class="picture-tiger">
                  <img src=<?= $row["image"] ?> alt="photo-d'un-tigre">
                </div>
                <div class="data-tiger">
                  <p>Prénom : <?= $row["name"] ?></p>
                  <p>Race : <?= $row["breed"] ?></p>
                  <p id="result_Tigre"></p>
                  <h6>Donnée du vétérinaire</h6>
                  <p>Etat : <?= $row["status"] ?></p>
                  <p>Nourriture : <?= $row["food"] ?></p>
                  <p>Quantité : <?= $row["quantity"] ?>g</p>
                  <p>Date de passage : <?= $row["date"] ?></p>
                  <p>Détail supplémentaire : <br> <?= $row["rapport_details"] ?>
                  </p>
                </div>
              </div>
            </div>
          <?php endwhile; ?>

          <?php
          $query = "
            SELECT 
                a.id AS animal_id, 
                a.breed, 
                a.name,
                a.image,
                r.date,
                r.detail AS rapport_details, 
                r.status, 
                r.food, 
                r.quantity
            FROM animal a
            LEFT JOIN rapport_veterinaire r ON a.id_rapport = r.rapport_veterinaire_id
            WHERE a.id = 2
        ";
          $statement = $bdd->prepare($query);
          $statement->execute();

          while ($row = $statement->fetch(PDO::FETCH_ASSOC)) :
          ?>
            <div class="elephant">
              <button onclick="incrementeView('Eléphant')">
                <h6><?= $row["breed"] ?> <img src="./icons/arrow-right.svg" alt="flèche-vers-la-droite" class="arrow-right"> <img
                    src="./icons/arrow-down.svg" alt="flèche-vers-le-bas" class="arrow-down"></h6>
              </button>
              <div class="card-elephant">
                <div class="picture-elephant">
                  <img src="./pictures/éléphant.jpg" alt="photo-d'un-éléphant">
                </div>
                <div class="data-elephant">
                  <p>Prénom : <?= $row["name"] ?></p>
                  <p>Race : <?= $row["breed"] ?></p>
                  <p id="result_Eléphant"></p>
                  <h6>Donnée du vétérinaire</h6>
                  <p>Etat : <?= $row["status"] ?></p>
                  <p>Nourriture : <?= $row["food"] ?></p>
                  <p>Quantité : <?= $row["quantity"] ?>g</p>
                  <p>Date de passage : <?= $row["date"] ?></p>
                  <p>Détail supplémentaire : <?= $row["rapport_details"] ?></p>
                </div>
              </div>
            </div>
          <?php endwhile; ?>

          <?php
          $query = "
            SELECT 
                a.id AS animal_id, 
                a.breed, 
                a.name,
                a.image,
                r.date,
                r.detail AS rapport_details, 
                r.status, 
                r.food, 
                r.quantity
            FROM animal a
            LEFT JOIN rapport_veterinaire r ON a.id_rapport = r.rapport_veterinaire_id
            WHERE a.id = 3
        ";
          $statement = $bdd->prepare($query);
          $statement->execute();

          while ($row = $statement->fetch(PDO::FETCH_ASSOC)) :
          ?>
            <div class="giraffe">
              <button onclick="incrementeView('Girafe')">
                <h6><?= $row["breed"] ?> <img src="./icons/arrow-right.svg" alt="flèche-vers-la-droite" class="arrow-right"> <img
                    src="./icons/arrow-down.svg" alt="flèche-vers-le-bas" class="arrow-down"></h6>
              </button>
              <div class="card-giraffe">
                <div class="picture-giraffe">
                  <img src="./pictures/girafe.jpg" alt="photo-d'une-girafe">
                </div>
                <div class="data-giraffe">
                  <p>Prénom : <?= $row["name"] ?></p>
                  <p>Race : <?= $row["breed"] ?></p>
                  <p id="result_Girafe"></p>
                  <h6>Donnée du vétérinaire</h6>
                  <p>Etat : <?= $row["status"] ?></p>
                  <p>Nourriture : <?= $row["food"] ?></p>
                  <p>Quantité : <?= $row["quantity"] ?>g</p>
                  <p>Date de passage : <?= $row["date"] ?></p>
                  <p>Détail supplémentaire : <?= $row["rapport_details"] ?></p>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
          <?php
          $query = "
            SELECT 
                a.id AS animal_id, 
                a.breed, 
                a.name,
                a.image,
                r.date,
                r.detail AS rapport_details, 
                r.status, 
                r.food, 
                r.quantity
            FROM animal a
            LEFT JOIN rapport_veterinaire r ON a.id_rapport = r.rapport_veterinaire_id
            WHERE a.id = 4
        ";
          $statement = $bdd->prepare($query);
          $statement->execute();

          while ($row = $statement->fetch(PDO::FETCH_ASSOC)) :
          ?>
            <div class="zebra">
              <button onclick="incrementeView('Zèbre')">
                <h6><?= $row["breed"] ?> <img src="./icons/arrow-right.svg" alt="flèche-vers-la-droite" class="arrow-right"> <img
                    src="./icons/arrow-down.svg" alt="flèche-vers-le-bas" class="arrow-down"></h6>
              </button>
              <div class="card-zebra">
                <div class="picture-zebra">
                  <img src="./pictures/zèbre.jpg" alt="photo-d'un-zèbre">
                </div>
                <div class="data-zebra">
                  <p>Prénom : <?= $row["name"] ?></p>
                  <p>Race : <?= $row["breed"] ?></p>
                  <p id="result_Zèbre"></p>
                  <h6>Donnée du vétérinaire</h6>
                  <p>Etat : <?= $row["status"] ?></p>
                  <p>Nourriture : <?= $row["food"] ?></p>
                  <p>Quantité : <?= $row["quantity"] ?></p>
                  <p>Date de passage : <?= $row["date"] ?></p>
                  <p>Détail supplémentaire : <?= $row["rapport_details"] ?></p>
                </div>
              </div>
            </div>
          <?php endwhile; ?>

          <?php
          $query = "
            SELECT 
                a.id AS animal_id, 
                a.breed, 
                a.name,
                a.image,
                r.date,
                r.detail AS rapport_details, 
                r.status, 
                r.food, 
                r.quantity
            FROM animal a
            LEFT JOIN rapport_veterinaire r ON a.id_rapport = r.rapport_veterinaire_id
            WHERE a.id = 5
        ";
          $statement = $bdd->prepare($query);
          $statement->execute();

          while ($row = $statement->fetch(PDO::FETCH_ASSOC)) :
          ?>
            <div class="lion">
              <button onclick="incrementeView('Lion')">
                <h6><?= $row["breed"] ?> <img src="./icons/arrow-right.svg" alt="flèche-vers-la-droite" class="arrow-right"> <img
                    src="./icons/arrow-down.svg" alt="flèche-vers-le-bas" class="arrow-down"></h6>
              </button>
              <div class="card-lion">
                <div class="picture-lion">
                  <img src="./pictures/lion.jpg" alt="photo-d'un-lion">
                </div>
                <div class="data-lion">
                  <p>Prénom : <?= $row["name"] ?></p>
                  <p>Race : <?= $row["breed"] ?></p>
                  <p id="result_Lion"></p>
                  <h6>Donnée du vétérinaire</h6>
                  <p>Etat : <?= $row["status"] ?></p>
                  <p>Nourriture : <?= $row["food"] ?></p>
                  <p>Quantité : <?= $row["quantity"] ?></p>
                  <p>Date de passage : <?= $row["date"] ?></p>
                  <p>Détail supplémentaire : <?= $row["rapport_details"] ?></p>
                </div>
              </div>
            </div>
        </div>
      <?php endwhile; ?>

      <?php
      $query = "
            SELECT 
                a.id AS animal_id, 
                a.breed, 
                a.name,
                a.image,
                r.date,
                r.detail AS rapport_details, 
                r.status, 
                r.food, 
                r.quantity
            FROM animal a
            LEFT JOIN rapport_veterinaire r ON a.id_rapport = r.rapport_veterinaire_id
            WHERE a.id = 6
        ";
      $statement = $bdd->prepare($query);
      $statement->execute();

      while ($row = $statement->fetch(PDO::FETCH_ASSOC)) :
      ?>
        <div class="swamp">
          <h4 id="click-swamp">Les marais</h4>
          <p>Un marais est une formation paysagère au relief relativement plat, soumise aux inondations fréquentes ou
            continues</p>
          <h5>Les animaux de la savane sont :</h5>
          <div class="alligator">
            <button onclick="incrementeView('Alligator')">
              <h6><?= $row["breed"] ?> <img src="./icons/arrow-right.svg" alt="flèche-vers-la-droite" class="arrow-right"> <img
                  src="./icons/arrow-down.svg" alt="flèche-vers-le-bas" class="arrow-down"></h6>
            </button>
            <div class="card-alligator">
              <div class="picture-alligator">
                <img src="./pictures/alligator.jpg" alt="photo-d'un-alligator">
              </div>
              <div class="data-alligator">
                <p>Prénom : <?= $row["name"] ?></p>
                <p>Race : <?= $row["breed"] ?></p>
                <p id="result_Alligator"></p>
                <h6>Donnée du vétérinaire</h6>
                <p>Etat : <?= $row["status"] ?></p>
                <p>Nourriture : <?= $row["food"] ?></p>
                <p>Quantité : <?= $row["quantity"] ?></p>
                <p>Date de passage : <?= $row["date"] ?></p>
                <p>Détail supplémentaire : <?= $row["rapport_details"] ?></p>
              </div>
            </div>
          </div>
        <?php endwhile; ?>

        <?php
        $query = "
            SELECT 
                a.id AS animal_id, 
                a.breed, 
                a.name,
                a.image,
                r.date,
                r.detail AS rapport_details, 
                r.status, 
                r.food, 
                r.quantity
            FROM animal a
            LEFT JOIN rapport_veterinaire r ON a.id_rapport = r.rapport_veterinaire_id
            WHERE a.id = 7
        ";
        $statement = $bdd->prepare($query);
        $statement->execute();

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) :
        ?>
          <div class="caiman">
            <button onclick="incrementeView('Caïman')">
              <h6><?= $row["breed"] ?> <img src="./icons/arrow-right.svg" alt="flèche-vers-la-droite" class="arrow-right"> <img
                  src="./icons/arrow-down.svg" alt="flèche-vers-le-bas" class="arrow-down"></h6>
            </button>
            <div class="card-caiman">
              <div class="picture-caiman">
                <img src="./pictures/caiman.jpg" alt="photo-d'un-caiman">
              </div>
              <div class="data-caiman">
                <p>Prénom : <?= $row["name"] ?></p>
                <p>Race : <?= $row["breed"] ?></p>
                <p id="result_Caïman"></p>
                <h6>Donnée du vétérinaire</h6>
                <p>Etat : <?= $row["status"] ?></p>
                <p>Nourriture : <?= $row["food"] ?></p>
                <p>Quantité : <?= $row["quantity"] ?></p>
                <p>Date de passage : <?= $row["date"] ?></p>
                <p>Détail supplémentaire : <?= $row["rapport_details"] ?></p>
              </div>
            </div>
          </div>
        <?php endwhile; ?>

        <?php
        $query = "
            SELECT 
                a.id AS animal_id, 
                a.breed, 
                a.name,
                a.image,
                r.date,
                r.detail AS rapport_details, 
                r.status, 
                r.food, 
                r.quantity
            FROM animal a
            LEFT JOIN rapport_veterinaire r ON a.id_rapport = r.rapport_veterinaire_id
            WHERE a.id = 8
        ";
        $statement = $bdd->prepare($query);
        $statement->execute();

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) :
        ?>
          <div class="crocodile">
            <button onclick="incrementeView('Crocodile')">
              <h6><?= $row["breed"] ?> <img src="./icons/arrow-right.svg" alt="flèche-vers-la-droite" class="arrow-right"> <img
                  src="./icons/arrow-down.svg" alt="flèche-vers-le-bas" class="arrow-down"></h6>
            </button>
            <div class="card-crocodile">
              <div class="picture-crocodile">
                <img src="./pictures/crocodile.jpg" alt="photo-d'un-crocodile">
              </div>
              <div class="data-crocodile">
                <p>Prénom : <?= $row["name"] ?></p>
                <p>Race : <?= $row["breed"] ?></p>
                <p id="result_Crocodile"></p>
                <h6>Donnée du vétérinaire</h6>
                <p>Etat : <?= $row["status"] ?></p>
                <p>Nourriture : <?= $row["food"] ?></p>
                <p>Quantité : <?= $row["quantity"] ?></p>
                <p>Date de passage : <?= $row["date"] ?></p>
                <p>Détail supplémentaire : <?= $row["rapport_details"] ?></p>
              </div>
            </div>
          </div>
        <?php endwhile; ?>

        <?php
        $query = "
            SELECT 
                a.id AS animal_id, 
                a.breed, 
                a.name,
                a.image,
                r.date,
                r.detail AS rapport_details, 
                r.status, 
                r.food, 
                r.quantity
            FROM animal a
            LEFT JOIN rapport_veterinaire r ON a.id_rapport = r.rapport_veterinaire_id
            WHERE a.id = 9
        ";
        $statement = $bdd->prepare($query);
        $statement->execute();

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) :
        ?>
          <div class="anaconda">
            <button onclick="incrementeView('Anaconda')">
              <h6><?= $row["breed"] ?> <img src="./icons/arrow-right.svg" alt="flèche-vers-la-droite" class="arrow-right"> <img
                  src="./icons/arrow-down.svg" alt="flèche-vers-le-bas" class="arrow-down"></h6>
            </button>
            <div class="card-anaconda">
              <div class="picture-anaconda">
                <img src="./pictures/anaconda.jpg" alt="photo-d'un-anaconda">
              </div>
              <div class="data-anaconda">
                <p>Prénom : <?= $row["name"] ?></p>
                <p>Race : <?= $row["breed"] ?></p>
                <p id="result_Anaconda"></p>
                <h6>Donnée du vétérinaire</h6>
                <p>Etat : <?= $row["status"] ?></p>
                <p>Nourriture : <?= $row["food"] ?></p>
                <p>Quantité : <?= $row["quantity"] ?></p>
                <p>Date de passage : <?= $row["date"] ?></p>
                <p>Détail supplémentaire : <?= $row["rapport_details"] ?></p>
              </div>
            </div>
          </div>
        <?php endwhile; ?>

        <?php
        $query = "
            SELECT 
                a.id AS animal_id, 
                a.breed, 
                a.name,
                a.image,
                r.date,
                r.detail AS rapport_details, 
                r.status, 
                r.food, 
                r.quantity
            FROM animal a
            LEFT JOIN rapport_veterinaire r ON a.id_rapport = r.rapport_veterinaire_id
            WHERE a.id = 10
        ";
        $statement = $bdd->prepare($query);
        $statement->execute();

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) :
        ?>
          <div class="grass-snake">
            <button onclick="incrementeView('Couleuvre à collier')">
              <h6><?= $row["breed"] ?> <img src="./icons/arrow-right.svg" alt="flèche-vers-la-droite"
                  class="arrow-right">
                <img src="./icons/arrow-down.svg" alt="flèche-vers-le-bas" class="arrow-down">
              </h6>
            </button>
            <div class="card-grass-snake">
              <div class="picture-grass-snake">
                <img src="./pictures/couleuvre.jpg" alt="photo-d'un-grass-snake">
              </div>
              <div class="data-grass-snake">
                <p>Prénom : <?= $row["name"] ?></p>
                <p>Race : <?= $row["breed"] ?></p>
                <p id="result_Couleuvre_à_collier"></p>
                <h6>Donnée du vétérinaire</h6>
                <p>Etat : <?= $row["status"] ?></p>
                <p>Nourriture : <?= $row["food"] ?></p>
                <p>Quantité : <?= $row["quantity"] ?></p>
                <p>Date de passage : <?= $row["date"] ?></p>
                <p>Détail supplémentaire : <?= $row["rapport_details"] ?></p>
              </div>
            </div>
          </div>
        </div>
      <?php endwhile; ?>

      <?php
      $query = "
            SELECT 
                a.id AS animal_id, 
                a.breed, 
                a.name,
                a.image,
                r.date,
                r.detail AS rapport_details, 
                r.status, 
                r.food, 
                r.quantity
            FROM animal a
            LEFT JOIN rapport_veterinaire r ON a.id_rapport = r.rapport_veterinaire_id
            WHERE a.id = 11
        ";
      $statement = $bdd->prepare($query);
      $statement->execute();

      while ($row = $statement->fetch(PDO::FETCH_ASSOC)) :
      ?>
        <div class="jungle">
          <h4 id="click-jungle">La jungle</h4>
          <p>La jungle est une formation végétale arborée qui prospère sous un climat chaud et humide avec une courte
            saison sèche</p>
          <h5>Les animaux de la jungle sont :</h5>
          <div class="panda">
            <button onclick="incrementeView('Panda')">
              <h6><?= $row["breed"] ?> <img src="./icons/arrow-right.svg" alt="flèche-vers-la-droite" class="arrow-right"> <img
                  src="./icons/arrow-down.svg" alt="flèche-vers-le-bas" class="arrow-down"></h6>
            </button>
            <div class="card-panda">
              <div class="picture-panda">
                <img src="./pictures/panda-2.jpg" alt="photo-d'un-panda">
              </div>
              <div class="data-panda">
                <p>Prénom : <?= $row["name"] ?></p>
                <p>Race : <?= $row["breed"] ?></p>
                <p id="result_Panda"></p>
                <h6>Donnée du vétérinaire</h6>
                <p>Etat : <?= $row["status"] ?></p>
                <p>Nourriture : <?= $row["food"] ?></p>
                <p>Quantité : <?= $row["quantity"] ?></p>
                <p>Date de passage : <?= $row["date"] ?></p>
                <p>Détail supplémentaire : <?= $row["rapport_details"] ?></p>
              </div>
            </div>
          </div>
        <?php endwhile; ?>

        <?php
        $query = "
            SELECT 
                a.id AS animal_id, 
                a.breed, 
                a.name,
                a.image,
                r.date,
                r.detail AS rapport_details, 
                r.status, 
                r.food, 
                r.quantity
            FROM animal a
            LEFT JOIN rapport_veterinaire r ON a.id_rapport = r.rapport_veterinaire_id
            WHERE a.id = 12
        ";
        $statement = $bdd->prepare($query);
        $statement->execute();

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) :
        ?>
          <div class="gorilla">
            <button onclick="incrementeView('Gorille')">
              <h6><?= $row["breed"] ?> <img src="./icons/arrow-right.svg" alt="flèche-vers-la-droite" class="arrow-right"> <img
                  src="./icons/arrow-down.svg" alt="flèche-vers-le-bas" class="arrow-down"></h6>
            </button>
            <div class="card-gorilla">
              <div class="picture-gorilla">
                <img src="./pictures/gorille.jpg" alt="photo-d'un-gorilla">
              </div>
              <div class="data-gorilla">
                <p>Prénom : <?= $row["name"] ?></p>
                <p>Race : <?= $row["breed"] ?></p>
                <p id="result_Gorille"></p>
                <h6>Donnée du vétérinaire</h6>
                <p>Etat : <?= $row["status"] ?></p>
                <p>Nourriture : <?= $row["food"] ?></p>
                <p>Quantité : <?= $row["quantity"] ?></p>
                <p>Date de passage : <?= $row["date"] ?></p>
                <p>Détail supplémentaire : <?= $row["rapport_details"] ?></p>
              </div>
            </div>
          </div>
        <?php endwhile; ?>

        <?php
        $query = "
            SELECT 
                a.id AS animal_id, 
                a.breed, 
                a.name,
                a.image,
                r.date,
                r.detail AS rapport_details, 
                r.status, 
                r.food, 
                r.quantity
            FROM animal a
            LEFT JOIN rapport_veterinaire r ON a.id_rapport = r.rapport_veterinaire_id
            WHERE a.id = 13
        ";
        $statement = $bdd->prepare($query);
        $statement->execute();

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) :
        ?>
          <div class="python">
            <button onclick="incrementeView('Python')">
              <h6><?= $row["breed"] ?> <img src="./icons/arrow-right.svg" alt="flèche-vers-la-droite" class="arrow-right"> <img
                  src="./icons/arrow-down.svg" alt="flèche-vers-le-bas" class="arrow-down"></h6>
            </button>
            <div class="card-python">
              <div class="picture-python">
                <img src="./pictures/python.jpg" alt="photo-d'un-python">
              </div>
              <div class="data-python">
                <p>Prénom : <?= $row["name"] ?></p>
                <p>Race : <?= $row["breed"] ?></p>
                <p id="result_Python"></p>
                <h6>Donnée du vétérinaire</h6>
                <p>Etat : <?= $row["status"] ?></p>
                <p>Nourriture : <?= $row["food"] ?></p>
                <p>Quantité : <?= $row["quantity"] ?></p>
                <p>Date de passage : <?= $row["date"] ?></p>
                <p>Détail supplémentaire : <?= $row["rapport_details"] ?></p>
              </div>
            </div>
          </div>
        <?php endwhile; ?>

        <?php
        $query = "
            SELECT 
                a.id AS animal_id, 
                a.breed, 
                a.name,
                a.image,
                r.date,
                r.detail AS rapport_details, 
                r.status, 
                r.food, 
                r.quantity
            FROM animal a
            LEFT JOIN rapport_veterinaire r ON a.id_rapport = r.rapport_veterinaire_id
            WHERE a.id = 14
        ";
        $statement = $bdd->prepare($query);
        $statement->execute();

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) :
        ?>
          <div class="toucan-toco">
            <button onclick="incrementeView('Toucan toco')">
              <h6><?= $row["breed"] ?> <img src="./icons/arrow-right.svg" alt="flèche-vers-la-droite" class="arrow-right"> <img
                  src="./icons/arrow-down.svg" alt="flèche-vers-le-bas" class="arrow-down"></h6>
            </button>
            <div class="card-toucan-toco">
              <div class="picture-toucan-toco">
                <img src="./pictures/toucan.jpg" alt="photo-d'un-toucan-toco">
              </div>
              <div class="data-toucan-toco">
                <p>Prénom : <?= $row["name"] ?></p>
                <p>Race : <?= $row["breed"] ?></p>
                <p id="result_Toucan_toco"></p>
                <h6>Donnée du vétérinaire</h6>
                <p>Etat : <?= $row["status"] ?></p>
                <p>Nourriture : <?= $row["food"] ?></p>
                <p>Quantité : <?= $row["quantity"] ?></p>
                <p>Date de passage : <?= $row["date"] ?></p>
                <p>Détail supplémentaire : <?= $row["rapport_details"] ?></p>
              </div>
            </div>
          </div>
        <?php endwhile; ?>

        <?php
        $query = "
            SELECT 
                a.id AS animal_id, 
                a.breed, 
                a.name,
                a.image,
                r.date,
                r.detail AS rapport_details, 
                r.status, 
                r.food, 
                r.quantity
            FROM animal a
            LEFT JOIN rapport_veterinaire r ON a.id_rapport = r.rapport_veterinaire_id
            WHERE a.id = 15
        ";
        $statement = $bdd->prepare($query);
        $statement->execute();

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) :
        ?>
          <div class="black-panther">
            <button onclick="incrementeView('Panthère noire')">
              <h6><?= $row["breed"] ?> <img src="./icons/arrow-right.svg" alt="flèche-vers-la-droite" class="arrow-right">
                <img src="./icons/arrow-down.svg" alt="flèche-vers-le-bas" class="arrow-down">
              </h6>
            </button>
            <div class="card-black-panther">
              <div class="picture-black-panther">
                <img src="./pictures/panthère.jpg" alt="photo-d'un-black-panther">
              </div>
              <div class="data-black-panther">
                <p>Prénom : <?= $row["name"] ?></p>
                <p>Race : <?= $row["breed"] ?></p>
                <p id="result_Panthère_noire"></p>
                <h6>Donnée du vétérinaire</h6>
                <p>Etat : <?= $row["status"] ?></p>
                <p>Nourriture : <?= $row["food"] ?></p>
                <p>Quantité : <?= $row["quantity"] ?></p>
                <p>Date de passage : <?= $row["date"] ?></p>
                <p>Détail supplémentaire : <?= $row["rapport_details"] ?></p>
              </div>
            </div>
          <?php endwhile; ?>
          </div>
        </div>
      </div>
    </section>
  </main>

  <footer>
    <hr class="break-center">
  </footer>
</body>

</html>