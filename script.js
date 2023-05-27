/* CONNEXIONS ENTRE PAGES */
document.querySelector("#button-enregistrer").disabled = true;

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
  afficherCoordonnees();
}

function fermerSeConnecteEtOuvrirInscription() {
  fermerModaleConnexion();
  ouvrirModaleInscription();
}

/* FIL ARIANE */
const adresse = document.querySelector("#inscriptions-adresse");
const avatar = document.querySelector("#inscriptions-avatar");
const coordonnees = document.querySelector("#inscriptions-coordonnees");
const verifications = document.querySelector("#inscriptions-verifications");
const boutonFilAriane1 = document.querySelector("#inscription-value-1");
const boutonFilAriane2 = document.querySelector("#inscription-value-2");
const boutonFilAriane3 = document.querySelector("#inscription-value-3");
const boutonFilAriane4 = document.querySelector("#inscription-value-4");

let coordonneesRemplies = false;
let avatarRempli = false;
let verificationsRemplies = false;

function afficherCoordonnees() {
  boutonFilAriane1.style.color = "#FFFFFF";
  boutonFilAriane2.style.color = "inherit";
  boutonFilAriane3.style.color = "inherit";
  boutonFilAriane4.style.color = "inherit";

  coordonnees.style.display = "flex";
  avatar.style.display = "none";
  adresse.style.display = "none";
  verifications.style.display = "none";
}

function afficherAdressePostal() {
  if (validerCoordonnees()) {
    boutonFilAriane1.style.color = "inherit";
    boutonFilAriane2.style.color = "#FFFFFF";
    boutonFilAriane3.style.color = "inherit";
    boutonFilAriane4.style.color = "inherit";

    avatar.style.display = "none";
    adresse.style.display = "flex";
    coordonnees.style.display = "none";
    verifications.style.display = "none";
  } else {
    alert(
      "Veuillez remplir tous les champs de coordonnées avant de passer à l'adresse postale."
    );
  }
}

function afficherAvatar() {
  if (coordonneesRemplies && avatarRempli) {
    boutonFilAriane1.style.color = "inherit";
    boutonFilAriane2.style.color = "inherit";
    boutonFilAriane3.style.color = "#FFFFFF";
    boutonFilAriane4.style.color = "inherit";

    coordonnees.style.display = "none";
    adresse.style.display = "none";
    avatar.style.display = "flex";
    verifications.style.display = "none";
  } else {
    alert(
      "Veuillez remplir tous les champs requis avant de passer à l'avatar."
    );
  }
}

function afficherVerifications() {
  if (coordonneesRemplies && avatarRempli && verificationsRemplies) {
    boutonFilAriane1.style.color = "inherit";
    boutonFilAriane2.style.color = "inherit";
    boutonFilAriane3.style.color = "inherit";
    boutonFilAriane4.style.color = "#FFFFFF";

    coordonnees.style.display = "none";
    adresse.style.display = "none";
    avatar.style.display = "none";
    verifications.style.display = "flex";
  } else {
    alert(
      "Veuillez remplir tous les champs requis avant de passer aux vérifications."
    );
  }
}

function validerCoordonnees() {
  const formulaire = document.querySelector("#inscriptions-coordonnees"); // On récupère le formulaire html
  const lastname = formulaire.querySelector("input[name='lastname']").value; // dans le formulaire on récupère la valeur de la balise input qui correspond au "name", "lastname"
  const firstname = formulaire.querySelector("input[name='firstname']").value;
  const email = formulaire.querySelector("input[name='email']").value;
  const birthday = formulaire.querySelector("input[name='birthday']").value;
  const pwd = formulaire.querySelector("input[name='pwd']").value;
  const pwdConfirm = formulaire.querySelector("input[name='pwdConfirm']").value;

  if (lastname.length < 2 || /\d/.test(lastname)) {
    alert(
      "Le nom doit contenir au moins 2 lettres et ne peut pas contenir de chiffres."
    );
    return false;
  }

  if (firstname.length < 2 || /\d/.test(firstname)) {
    alert(
      "Le prénom doit contenir au moins 2 lettres et ne peut pas contenir de chiffres."
    );
    return false;
  }

  if (email.length < 2) {
    ///^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/
    alert("L'email doit contenir au moins deux caractères");
  }

  if (!/(?=.*[A-Z])(?=.*[<>!@#$%^&*\d])(?=.{12,})/.test(pwd)) {
    alert(
      "Le mod de passe doit contenir 12 caractères avec une lettre majuscule, un caractère spécial et un chiffre"
    );
    return false;
  }

  if (pwd !== pwdConfirm) {
    alert(
      "Le mot de passe de confirmation ne correspond pas au mot de passe indiqué, veuillez "
    );
    return false;
  }

  return true;
}

//Puzzle

let puzzleEstCorrect = false;
const pieces = document.querySelectorAll(".puzzle-piece");
const puzzle = document.querySelector("#puzzle");
let pieceAttrapee, pieceRelachee;
const images = Array.from(pieces);
images.sort(() => Math.random() - 0.5);
images.forEach((image) => {
  image.parentNode.insertBefore(image, image.parentNode.firstChild);
});

pieces.forEach((p) => {
  p.addEventListener("dragstart", (evenement) => {
    pieceAttrapee = evenement;
  });

  p.addEventListener("dragover", (evenement) => {
    pieceRelachee = evenement;
  });
  p.addEventListener("dragend", () => {
    if (pieceAttrapee && pieceRelachee) {
      const div1 = pieceRelachee.target;
      const div2 = pieceAttrapee.target;
      let div3 = div2.nextSibling;
      const pieceDePuzzle = puzzle.querySelectorAll(".puzzle-piece");

      const dernier = pieceDePuzzle[pieceDePuzzle.length - 1];
      if (div1 === div3) {
        puzzle.insertBefore(div1, div2);
      } else if (div3 !== dernier) {
        puzzle.replaceChild(div2, div1);
        puzzle.insertBefore(div1, div3);
      } else {
        puzzle.replaceChild(div2, div1);
        puzzle.appendChild(div1);
      }
    }
    puzzleEstBon();
    pieceAttrapee = null;
    pieceRelachee = null;
  });
});

function puzzleEstBon() {
  const puzzleEstBon = document.querySelectorAll(".puzzle-piece");
  let estBon = true;
  puzzleEstBon.forEach((piece, index) => {
    const numeroPiece = index + 1;
    if (piece.id !== "piece-" + numeroPiece) {
      estBon = false;
    }
  });

  document.querySelector("#button-enregistrer").disabled = !estBon;

  puzzleEstCorrect = estBon;
}

// creation d'avatar
let couleurPeau = [
  "#ffdbb4",
  "#edb98a",
  "#fd9841",
  "#fcee93",
  "#d08b5b",
  "#ae5d29",
  "#614335",
];
let couleurCheveux = [
  "#fd9841",
  "#d08b5b",
  "#ffdbb4",
  "#edb98a",
  "#fcee93",
  "#ae5d29",
  "#614335",
];
let peau = ["#peau-1", "#peau-2"];
let cheveux = ["#cheveux-1", "#cheveux-2"];
let yeux = ["#yeux-1", "#yeux-2"];
let accessoires = ["#none", "#lunettes"];
let pilosite = ["#none", "#pilosite-1", "#pilosite-2"];
let bouche = ["#none", "#bouche-1", "#bouche-2", "#bouche-4"];

let iCouleurPeau = 0;
let iCouleurCheveux = 0;
let iYeux = 0;
let iAccessoire = 0;
let iCoiffure = 0;
let iPilosite = 0;
let iBouche = 0;

function changerCouleurPeau() {
  iCouleurPeau++;
  const cheveux =
    "--couleur-cheveux: " +
    couleurCheveux[iCouleurCheveux % couleurCheveux.length] +
    ";";
  const peau =
    "--couleur-peau: " + couleurPeau[iCouleurPeau % couleurPeau.length] + ";";
  document.querySelector("body").style = cheveux + peau;
  console.log(couleurPeau, "couleurPeau");
}

function changerCouleurCheveux() {
  iCouleurCheveux++;
  const cheveux =
    "--couleur-cheveux: " +
    couleurCheveux[iCouleurCheveux % couleurCheveux.length] +
    ";";
  const peau =
    "--couleur-peau: " + couleurPeau[iCouleurPeau % couleurPeau.length] + ";";
  document.querySelector("body").style = cheveux + peau;
  console.log(couleurCheveux);
}

function changerCoiffure() {
  document.querySelector("#cheveuxSelectionne").href.baseVal =
    cheveux[iCoiffure % cheveux.length];
  iCoiffure++;
  console.log(cheveux);
}

function changerYeux() {
  document.querySelector("#yeuxSelectionne").href.baseVal =
    yeux[iYeux % yeux.length];
  iYeux++;
  console.log(yeux);
}

function changerAccessoire() {
  document.querySelector("#accesoireSelectionne").href.baseVal =
    accessoires[iAccessoire % accessoires.length];
  iAccessoire++;
  console.log(accessoires);
}

function changerPilosite() {
  document.querySelector("#pilositeSelectionne").href.baseVal =
    pilosite[iPilosite % pilosite.length];
  iPilosite++;
  console.log(pilosite);
}

function changerBouche() {
  document.querySelector("#boucheSelectionne").href.baseVal =
    bouche[iBouche % bouche.length];
  iBouche++;
  console.log(bouche);
}

changerCouleurPeau();
changerCoiffure();
changerYeux();
changerAccessoire();
changerPilosite();
changerBouche();
changerCouleurCheveux();
//enregistrement avatar
function verificationsAdd() {
  // Mettre à jour les valeurs des champs cachés avec les valeurs actuelles de l'avatar
  document.getElementById("couleurPeauInput").value =
    couleurPeau[iCouleurPeau % couleurPeau.length];
  document.getElementById("couleurCheveuxInput").value =
    couleurCheveux[iCouleurCheveux % couleurCheveux.length];
  document.getElementById("coiffureInput").value =
    cheveux[iCoiffure % cheveux.length];
  document.getElementById("yeuxInput").value = yeux[iYeux % yeux.length];
  document.getElementById("accessoireInput").value =
    accessoires[iAccessoire % accessoires.length];
  document.getElementById("pilositeInput").value =
    pilosite[iPilosite % pilosite.length];
  document.getElementById("boucheInput").value =
    bouche[iBouche % bouche.length];

  // Soumettre le formulaire
  document.getElementById("avatar-form").submit();
}

// Rajouter le s si plusieurs recettes en attente

window.addEventListener("DOMContentLoaded", function () {
  var h2Recette = document.querySelector(".h2-recette-validation-attente");
  var nombreRecettes = 2;
  var recetteElement = h2Recette.querySelector(".recette");
  var pluralElement = h2Recette.querySelector(".plural");

  if (nombreRecettes > 1) {
    recetteElement.style.display = 'none';
    pluralElement.style.display = 'inline';
}
});

console.log(texteRecette);

// console.log("Couleur de peau:", couleurPeauInput);
// console.log("Couleur de cheveux:", couleurCheveuxInput);
// console.log("Coiffure:", coiffureInput);
// console.log("Yeux:", yeuxInput);
// console.log("Accessoire:", accessoireInput);
// console.log("Pilositée:", pilositeInput);
// console.log("Bouche:", boucheInput);
