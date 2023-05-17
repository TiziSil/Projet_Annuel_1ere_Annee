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
  document.querySelector("#inscription-value-1").checked = true;
  avatar.style.display = "none";
  coordonnees.style.display = "flex";
  adresse.style.display = "none";
  verifications.style.display = "none";
}

function afficherAdressePostal() {
  document.querySelector("#inscription-value-2").checked = true;
  avatar.style.display = "none";
  coordonnees.style.display = "none";
  adresse.style.display = "flex";
  verifications.style.display = "none";
}

function afficherAvatar() {
  document.querySelector("#inscription-value-3").checked = true;
  avatar.style.display = "flex";
  coordonnees.style.display = "none";
  adresse.style.display = "none";
  verifications.style.display = "none";
}

function afficherVerifications() {
  document.querySelector("#inscription-value-4").checked = true;
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
  "#ffdbb4",
  "#edb98a",
  "#fd9841",
  "#fcee93",
  "#d08b5b",
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
  document.getElementById("couleurPeauInput").value = couleurPeau[iCouleurPeau % couleurPeau.length];
  document.getElementById("couleurCheveuxInput").value = couleurCheveux[iCouleurCheveux % couleurCheveux.length];
  document.getElementById("coiffureInput").value = cheveux[iCoiffure % cheveux.length];
  document.getElementById("yeuxInput").value = yeux[iYeux % yeux.length];
  document.getElementById("accessoireInput").value = accessoires[iAccessoire % accessoires.length];
  document.getElementById("pilositeInput").value = pilosite[iPilosite % pilosite.length];
  document.getElementById("boucheInput").value = bouche[iBouche % bouche.length];
  
  // Soumettre le formulaire
  document.getElementById("avatar-form").submit();
}


console.log('Couleur de peau:', couleurPeauInput);
console.log('Couleur de cheveux:', couleurCheveuxInput);
console.log('Coiffure:', coiffureInput);
console.log('Yeux:', yeuxInput);
console.log('Accessoire:', accessoireInput);
console.log('Pilositée:', pilositeInput);
console.log('Bouche:', boucheInput);
