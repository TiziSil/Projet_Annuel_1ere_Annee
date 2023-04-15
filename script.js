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

function afficherListePays() {
  console.log(listeDesPays);
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

// var filAriane = "Accueil";

// filAriane += " > Coordonnées";

// filAriane += " > Adresse postale";

// // Afficher le fil d'Ariane sur la page
// var filArianeElement = document.getElementById("fil-ariane");
// filArianeElement.innerHTML = filAriane;

recupererListeDesPays();


//Captcha