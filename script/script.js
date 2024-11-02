const ul = document.querySelector("ul");
const hamburger = document.getElementById("hamburger");

hamburger.addEventListener("click", () => {
  ul.classList.toggle("active");
});
