/* CONNEXIONS ENTRE PAGE */

function ouvrirModaleConnexion() {
  const modale = document.querySelector("#modale-connexion");
  modale.style.display = "block";
  console.log(modale);
}

function ouvrirModaleInscription() {
  const modale = document.querySelector("#modale-inscription");
  modale.style.display = "block";
  console.log(modale);
}

function fermerModaleConnexion() {
  const modale = document.querySelector("#modale-connexion");
  modale.style.display = "none";
  console.log(modale);
}

function fermerModaleinscription() {
  const modale = document.querySelector("#modale-inscription");
  modale.style.display = "none";
  console.log(modale);
}

/* FIL ARIANE */
const adresse = document.querySelector("#inscriptions-adresse");
const avatar = document.querySelector("#inscriptions-avatar");
const coordonnees = document.querySelector("#inscriptions-coordonnees");
function afficherCoordonnees() {
  avatar.style.display = "none";
  coordonnees.style.display = "flex";
  adresse.style.display = "none";
}
function afficherAdressePostal() {
  avatar.style.display = "none";
  coordonnees.style.display = "none";
  adresse.style.display = "flex";
}
function afficherAvatar() {
  avatar.style.display = "flex";
  coordonnees.style.display = "none";
  adresse.style.display = "none";
}

// Liste pays INSCRIPTION

function listePays() {
  const autrePays = document.querySelector("#pays-inscription").value;
  console.log(autrePays);
  if (autrePays === "") {
    document.getElementById("autre-pays").style.display = "block";
  } else {
    document.getElementById("autre-pays").style.display = "none";
  }
}

//Captcha

