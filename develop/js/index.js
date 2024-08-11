// Names: Artin Azizi (041131883), Mohamed Dualeh (41137299), Raisa Rahman (041129634)
// Professor: Alemeseged Legesse
// File Name: index.js
// Date: 8/11/2024
// Description: JS page to facilitate a drowdown menu for search functionality.

let dropdown = document.querySelectorAll(".dropdown");

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", toggle);
}

function show(e) {
  document.querySelector(".text02").value = e;
}

function toggle() {
  this.classList.toggle("active");
}
