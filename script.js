/* CONNEXIONS ENTRE PAGE */
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
  console.log(modale);
}

/* FIL ARIANE */
const adresse = document.querySelector("#inscriptions-adresse");
const avatar = document.querySelector("#inscriptions-avatar");
const coordonnees = document.querySelector("#inscriptions-coordonnees");
const verifications = document.querySelector("#inscriptions-verifications");
function afficherCoordonnees() {
  avatar.style.display = "none";
  coordonnees.style.display = "flex";
  adresse.style.display = "none";
  verifications.style.display = "none";
}
function afficherAdressePostal() {
  avatar.style.display = "none";
  coordonnees.style.display = "none";
  adresse.style.display = "flex";
  verifications.style.display = "none";
}
function afficherAvatar() {
  avatar.style.display = "flex";
  coordonnees.style.display = "none";
  adresse.style.display = "none";
  verifications.style.display = "none";
}
function afficherVerifications() {
  coordonnees.style.display = "none";
  adresse.style.display = "none";
  avatar.style.display = "none";
  verifications.style.display = "flex";
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
    if (pieceAttrapee || pieceRelachee) {
      const div1 = pieceRelachee.target;
      const div2 = pieceAttrapee.target;
      const div3 = div2.nextSibling;
      const pieceDePuzzle = puzzle.querySelectorAll(".puzzle-piece");
      const dernier = pieceDePuzzle[pieceDePuzzle.length - 1];
      puzzle.replaceChild(div2, div1);
      if (div3 !== dernier) {
        puzzle.insertBefore(div1, div3);
      } else {
        puzzle.appendChild(div1);
      }
      pieceAttrapee = null;
      pieceRelachee = null;
      puzzleEstBon();
    }
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
  "#000000",
  "#edb98a",
  "#fd9841",
  "#fcee93",
  "#d08b5b",
  "#ae5d29",
  "#614335",
];
let cheveux = ["#cheveux-1", "#cheveux-2"];
let yeux = ["#yeux-1", "#yeux-2"];
let accessoires = ["#none", "#lunettes"];
let pilosite = ["#none", "#pilosite-1", "#pilosite-2"];
let bouche = ["#none", "#bouche-1", "#bouche-2", "#bouche-4"];

let iCouleurPeau = 0;
let iYeux = 0;
let iAccessoire = 0;
let iCheveux = 0;
let iPilosite = 0;
let icouleurCheveux = 0;
let ibouche = 0;

function changerCouleurPeau() {
  document.querySelector("body").style =
    "--fill-image: " + couleurPeau[iCouleurPeau % couleurPeau.length];
  iCouleurPeau++;
}

function changerCouleurCheveux() {
  document.querySelector("body").style =
    "--couleur-cheveux: " +
    couleurCheveux[icouleurCheveux % couleurCheveux.length];
  icouleurCheveux++;
}

function changerCheveux() {
  document.querySelector("#cheveuxSelectionner").href.baseVal =
    cheveux[iCheveux % cheveux.length];
  iCheveux++;
}

function changerYeux() {
  document.querySelector("#yeuxSelectionner").href.baseVal =
    yeux[iYeux % yeux.length];
  iYeux++;
}

function changerAccessoire() {
  document.querySelector("#accesoireSelectionner").href.baseVal =
    accessoires[iAccessoire % accessoires.length];
  iAccessoire++;
}

function changerPilosite() {
  document.querySelector("#pilositeSelectionner").href.baseVal =
    pilosite[iPilosite % pilosite.length];
  iPilosite++;
}

function changerBouche() {
  document.querySelector("#boucheSelectionner").href.baseVal =
    bouche[ibouche % bouche.length];
  ibouche++;
}

changerCouleurPeau();
changerCheveux();
changerYeux();
changerAccessoire();
changerPilosite();
changerBouche();
changerCouleurCheveux();
