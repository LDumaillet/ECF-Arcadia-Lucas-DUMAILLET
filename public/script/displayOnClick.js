const ul = document.querySelector("ul");
const hamburger = document.getElementById("hamburger");

const clickSavannah = document.getElementById("click-savannah");
const savannah = document.querySelector(".savannah");
const clickSwamp = document.getElementById("click-swamp");
const swamp = document.querySelector(".swamp");
const clickJungle = document.getElementById("click-jungle");
const jungle = document.querySelector(".jungle");
const tiger = document.querySelector(".tiger");
const elephant = document.querySelector(".elephant");
const giraffe = document.querySelector(".giraffe");
const zebra = document.querySelector(".zebra");
const lion = document.querySelector(".lion");
const alligator = document.querySelector(".alligator");
const caiman = document.querySelector(".caiman");
const crocodile = document.querySelector(".crocodile");
const anaconda = document.querySelector(".anaconda");
const grassSnake = document.querySelector(".grass-snake");
const panda = document.querySelector(".panda");
const gorilla = document.querySelector(".gorilla");
const python = document.querySelector(".python");
const toucanToco = document.querySelector(".toucan-toco");
const blackPanther = document.querySelector(".black-panther");
crocodile;

function toggleActived(select, affected) {
  select.addEventListener("click", () => {
    affected.classList.toggle("active");
  });
}

toggleActived(hamburger, ul);
toggleActived(clickSavannah, savannah);
toggleActived(clickSwamp, swamp);
toggleActived(clickJungle, jungle);
toggleActived(tiger, tiger);
toggleActived(elephant, elephant);
toggleActived(giraffe, giraffe);
toggleActived(zebra, zebra);
toggleActived(lion, lion);
toggleActived(alligator, alligator);
toggleActived(caiman, caiman);
toggleActived(crocodile, crocodile);
toggleActived(anaconda, anaconda);
toggleActived(grassSnake, grassSnake);
toggleActived(panda, panda);
toggleActived(gorilla, gorilla);
toggleActived(python, python);
toggleActived(toucanToco, toucanToco);
toggleActived(blackPanther, blackPanther);
