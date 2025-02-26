function incrementeView(animal) {
  // Remplace les espaces par des underscores
  let animalKey = animal.replace(/\s+/g, "_");
  // Vérifie si c'est le premier clic dans la session pour cet animal
  if (!sessionStorage.getItem(animalKey + "_viewed")) {
    let incr = new XMLHttpRequest();
    incr.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        alert("Une vue a été ajoutée à " + animal);
        sessionStorage.setItem(animalKey + "_viewed", "true");
      }
    };
    incr.open("POST", "/public/data/view/updateView.php", true);
    incr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    incr.send("animal=" + encodeURIComponent(animal));
  }

  // Lecture du nombre de vues
  let lire = new XMLHttpRequest();
  lire.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let objJSON = JSON.parse(this.responseText);
      document.getElementById("result_" + animalKey).innerText =
        "Le nombre de vues : " + objJSON.view;
    }
  };
  lire.open("POST", "/public/data/view/readView.php", true);
  lire.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  lire.send("animal=" + encodeURIComponent(animal));
}
