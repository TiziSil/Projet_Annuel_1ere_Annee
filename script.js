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
    alert("Veuillez remplir tous les champs de coordonnées avant de passer à l'adresse postale.");
  }
}

function afficherAvatar() {
  if (validerAdressePostale()) {
    boutonFilAriane1.style.color = "inherit";
    boutonFilAriane2.style.color = "inherit";
    boutonFilAriane3.style.color = "#FFFFFF";
    boutonFilAriane4.style.color = "inherit";

    coordonnees.style.display = "none";
    adresse.style.display = "none";
    avatar.style.display = "flex";
    verifications.style.display = "none";
  } else {
    alert("Veuillez remplir tous les champs requis avant de passer à l'avatar.");
  }
}

function afficherVerifications() {
  boutonFilAriane1.style.color = "inherit";
  boutonFilAriane2.style.color = "inherit";
  boutonFilAriane3.style.color = "inherit";
  boutonFilAriane4.style.color = "#FFFFFF";

  coordonnees.style.display = "none";
  adresse.style.display = "none";
  avatar.style.display = "none";
  verifications.style.display = "flex";
}


// function d'erreurs de champs
function champInvalide(champ, message) {
  champ.parentElement.querySelector(".error").innerText = message;
  champ.parentElement.querySelector(".error").style = "display:block";
  champ.parentElement.style = "box-shadow: inset 2px 5px 10px rgba(0, 0, 0, 0.7)";
}

function champValide(champ) {
  champ.parentElement.querySelector(".error").innerText = "";
  champ.parentElement.querySelector(".error").style = "display:none";
  champ.parentElement.style = "box-shadow: inset 2px 5px 10px rgba(0, 0, 0, 0.7), 0px 0px 8px rgba(67, 160, 71, 1)";
}

// Valider fil d'ariane coordoonées
const formulaire = document.querySelector("#inscriptions-coordonnees"); // On récupère le formulaire html
function validerLastName() {
  const lastname = formulaire.querySelector("input[name='lastname']"); // dans le formulaire on récupère la valeur de la balise input qui correspond au "name", "lastname"
  if (lastname.value.length < 2 || /\d/.test(lastname.value)) {
    champInvalide(lastname, "Le nom doit contenir au moins 2 lettres et ne peut pas contenir de chiffres.");
    return false;
  }
  champValide(lastname);
  return true;
}
function validerFirstname() {
  const firstname = formulaire.querySelector("input[name='firstname']");
  if (firstname.value.length < 2 || /\d/.test(firstname.value)) {
    champInvalide(firstname, "Le prénom doit contenir au moins 2 lettres et ne peut pas contenir de chiffres.");
    return false;
  }
  champValide(firstname);
  return true;
}
function validerMail() {
  const email = formulaire.querySelector("input[name='email']");
  if (email.value.length < 2) {
    champInvalide(email, "L'email doit contenir au moins deux caractères");
    return false;
  }
  champValide(email);
  return true;
}
function validerMotDePasse() {
  const pwd = formulaire.querySelector("input[name='pwd']");
  if (!/(?=.*[A-Z])(?=.*[<>!@#$%^&*\d])(?=.{8,})/.test(pwd.value)) {
    champInvalide(
      pwd,
      "Le mot de passe doit contenir 8 caractères avec une lettre majuscule, un caractère spécial et un chiffre"
    );
    return false;
  }
  champValide(pwd);
  return true;
}
function validerMotDePasseConfirmation() {
  const pwd = formulaire.querySelector("input[name='pwd']");
  const pwdConfirm = formulaire.querySelector("input[name='pwdConfirm']");
  if (pwd.value !== pwdConfirm.value) {
    champInvalide(pwdConfirm, "Le mot de passe de confirmation ne correspond pas au mot de passe indiqué, veuillez ");
    return false;
  }
  champValide(pwdConfirm);
  return true;
}

function validerCoordonnees() {
  return (
    validerLastName() && validerFirstname() && validerMail() && validerMotDePasse() && validerMotDePasseConfirmation()
  );
}

// Validation fil d'ariane inscriptions-adresse
const formulaireAdresse = document.querySelector("#inscriptions-adresse"); // On récupère le formulaire function html
function validerPseudo() {
  const pseudo = formulaireAdresse.querySelector("input[name='pseudo']"); // dans le formulaireAdresse on récupère la valeur de la balise input qui correspond au "name", "lastname"
  if (pseudo.value.length < 2) {
    champInvalide(pseudo, "Le pseudo doit contenir au moins 2 lettres");
    return false;
  }
  champValide(pseudo);
  return true;
}
function validerTelephone() {
  const telephone = formulaireAdresse.querySelector("input[name='telephone']");
  if (!/^(0|\+33)[1-9](\d{2}){4}$/.test(telephone.value)) {
    champInvalide(telephone, "Le téléphone doit être au format +33123456789 ou 0123456789");
    return false;
  }
  champValide(telephone);
  return true;
}
function validerAdressePostaleInput() {
  const adressePostal = formulaireAdresse.querySelector("input[name='address']");
  if (adressePostal.value.length < 2) {
    champInvalide(adressePostal, "L'adresse doit contenir au moins 2 lettres.");
    return false;
  }
  champValide(adressePostal);
  return true;
}
function validerCodePostal() {
  const codePostal = formulaireAdresse.querySelector("input[name='codepostal']");
  if (codePostal.value.length !== 5) {
    champInvalide(codePostal, "Le code postal doit être composé de 5 chiffres");
    return false;
  }
  champValide(codePostal);
  return true;
}
function validerVille() {
  const ville = formulaireAdresse.querySelector("input[name='ville']");
  if (ville.value.length < 2 || /\d/.test(ville)) {
    champInvalide(ville, "La ville doit contenir au moins 2 lettres et ne peut pas contenir de chiffres.");
    return false;
  }
  champValide(ville);
  return true;
}
function validerPays() {
  const pays = formulaireAdresse.querySelector("#pays-inscription");
  if (pays.value === "") {
    champInvalide(pays, "Le pays doit être selectionné");
    return false;
  }
  champValide(pays);
  return true;
}


// Valider Fil d'ariane adresse postale
function validerAdressePostale() {
  return validerPseudo() && validerTelephone() && validerAdressePostaleInput() && validerCodePostal() && validerVille() && validerPays()
}
//Puzzle

let puzzleEstCorrect = false; // On l'initialise à faux
const pieces = document.querySelectorAll(".puzzle-piece"); //Selectionne toutes les pièces du puzzle
const puzzle = document.querySelector("#puzzle"); // Selectionne le conteneur du puzzle
let pieceAttrapee, pieceRelachee; // Variables utilisées plus tard pour stocker les pièces attrapées et relâchées
const images = Array.from(pieces); // Création d'un tableau pour une meilleure utilisation
images.sort(() => Math.random() - 0.5); // permet de mélanger les pièces aléatoirement
images.forEach((image) => {
  image.parentNode.insertBefore(image, image.parentNode.firstChild);
});

pieces.forEach((p) => {
  p.addEventListener("dragstart", (evenement) => {
    // Ce qui permet de conserver la place de l'image que l'utilisateur à bougé
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
  "#fcee93", // Les différentes couleurs possible
  "#d08b5b",
  "#ae5d29",
  "#614335",
];
let couleurCheveux = ["#fd9841", "#d08b5b", "#ffdbb4", "#edb98a", "#fcee93", "#ae5d29", "#614335"];
let peau = ["#peau-1", "#peau-2"];
let cheveux = ["#cheveux-1", "#cheveux-2"];
let yeux = ["#yeux-1", "#yeux-2"]; // Tableaux représentant diffétentes options possibles
let accessoires = ["#none", "#lunettes"];
let pilosite = ["#none", "#pilosite-1", "#pilosite-2"];
let bouche = ["#none", "#bouche-1", "#bouche-2", "#bouche-4"];

let iCouleurPeau = 0;
let iCouleurCheveux = 0;
let iYeux = 0; // Définies à 0 pour indiquer par la première option par défault
let iAccessoire = 0;
let iCoiffure = 0;
let iPilosite = 0;
let iBouche = 0;

function changerCouleurPeau() {
  iCouleurPeau++;
  const cheveux = "--couleur-cheveux: " + couleurCheveux[iCouleurCheveux % couleurCheveux.length] + ";"; // Récupère la couleur de cheveux dans le tableau 'couleurCheveux' en revenant à la première couleur lorsque toutes les options ont été parcourues.
  const peau = "--couleur-peau: " + couleurPeau[iCouleurPeau % couleurPeau.length] + ";";
  document.querySelector("body").style = cheveux + peau; //MAJ la couleur des cheveux et de la peau de l'avatar en temps réel.
  console.log(couleurPeau, "couleurPeau");
}

function changerCouleurCheveux() {
  iCouleurCheveux++;
  const cheveux = "--couleur-cheveux: " + couleurCheveux[iCouleurCheveux % couleurCheveux.length] + ";";
  const peau = "--couleur-peau: " + couleurPeau[iCouleurPeau % couleurPeau.length] + ";";
  document.querySelector("body").style = cheveux + peau;
  console.log(couleurCheveux);
}

function changerCoiffure() {
  document.querySelector("#cheveuxSelectionne").href.baseVal = cheveux[iCoiffure % cheveux.length];
  iCoiffure++;
  console.log(cheveux);
}

function changerYeux() {
  document.querySelector("#yeuxSelectionne").href.baseVal = yeux[iYeux % yeux.length];
  iYeux++;
  console.log(yeux);
}

function changerAccessoire() {
  document.querySelector("#accesoireSelectionne").href.baseVal = accessoires[iAccessoire % accessoires.length];
  iAccessoire++;
  console.log(accessoires);
}

function changerPilosite() {
  document.querySelector("#pilositeSelectionne").href.baseVal = pilosite[iPilosite % pilosite.length];
  iPilosite++;
  console.log(pilosite);
}

function changerBouche() {
  document.querySelector("#boucheSelectionne").href.baseVal = bouche[iBouche % bouche.length];
  iBouche++;
  console.log(bouche);
}

changerCouleurPeau();
changerCoiffure();
changerYeux();
changerAccessoire(); // Fonctions appelées pour changer la couleur de peau/coiffure/couleur yeux etc
changerPilosite();
changerBouche();
changerCouleurCheveux();


//enregistrement avatar

function verificationsAdd() {
  document.getElementById("couleurPeauInput").value = couleurPeau[iCouleurPeau % couleurPeau.length]; // Mettre à jour les valeurs des champs cachés avec les valeurs actuelles de l'avatar
  document.getElementById("couleurCheveuxInput").value = couleurCheveux[iCouleurCheveux % couleurCheveux.length];
  document.getElementById("coiffureInput").value = cheveux[iCoiffure % cheveux.length];
  document.getElementById("yeuxInput").value = yeux[iYeux % yeux.length];
  document.getElementById("accessoireInput").value = accessoires[iAccessoire % accessoires.length];
  document.getElementById("pilositeInput").value = pilosite[iPilosite % pilosite.length];
  document.getElementById("boucheInput").value = bouche[iBouche % bouche.length];

  // Soumettre le formulaire
  document.getElementById("avatar-form").submit(); // Soumettre le formulaire avec l'id "avatar-form" pour ê envoyé au serveur
}

// Cookie
function boutonCookie(cname, cvalue, exdays) {
  const d = new Date();
  d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
  const expires = "expires=" + d.toUTCString();
  document.cookie = cname + "=" + cvalue + "; " + expires;
}

function accepterCookie() {
  const d = new Date();
  const expiration = 30;
  d.setTime(d.getTime() + expiration * 24 * 60 * 60 * 1000);
  const expires = "expires=" + d.toUTCString();
  document.cookie = "banniere_cookie=true; " + expires;
  afficherBanniereCookie();
}

function showCookie() {
  document.write(document.cookie);
}

function obtenirCookieBanniere() {
  const name = "banniere_cookie=";
  const ca = document.cookie.split(";");
  for (let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == " ") {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length) === "true";
    }
  }
  return false;
}

function afficherBanniereCookie() {
  const banniereCookie = document.querySelector("#banniere-cookies");
  const cookie = obtenirCookieBanniere();
  if (cookie) {
    banniereCookie.style.display = "none";
  } else {
    banniereCookie.style.display = "block";
  }
}

function refuserCookie() {
  const banniereCookie = document.querySelector("#banniere-cookies");
  banniereCookie.style.display = "none";
}

afficherBanniereCookie();

// afficher recette

function ouvrirModaleAfficherRecette(idRecette) {
  fetch("./core/recetteGet.php?id_recette=" + idRecette)
    .then((reponsePHP) => {
      if (reponsePHP.ok) {
        return reponsePHP.json();
      } else {
        console.log("Erreur : " + reponsePHP.statusText);
      }
      return reponsePHP.json();
    })
    .then((recette) => {
      const recette2 = recette[0];
      const modale = document.querySelector("#afficher-recette");
      modale.style.display = "block";
      modale.querySelector("#afficher-recette-titre").textContent = recette2.nom_recette;
      modale.querySelector("#afficher-recette-description").textContent = recette2.description_recette;
    });
}

function fermerModalAfficheRecette() {
  const modale = document.querySelector("#afficher-recette");
  modale.style.display = "none";
}


// Afficher et fermer modale des ingrédients

function ouvrirModaleAfficherIngredient(idRecette) {
  fetch("./core/ingredientsGet.php?id_recette=" + idRecette)
    .then((reponsePHP) => {
      if (reponsePHP.ok) {
        return reponsePHP.json();
      } else {
        console.log("Erreur : " + reponsePHP.statusText);
      }
      return reponsePHP.json();
    })
    .then((recette) => {
      const recette3 = recette[0];
      const modale = document.querySelector("#afficher-ingredient");
      modale.style.display = "block";
      modale.querySelector("#afficher-ingredient-titre").textContent = "Ingrédient";

      const descriptionListe = modale.querySelector("#afficher-ingredient-description");
      descriptionListe.innerHTML = "";

      recette.forEach((recette3) => {
        const listItem = document.createElement("li");
        listItem.textContent = recette3.quantite_ingredient + " " + recette3.nom_ingredient;
        descriptionListe.appendChild(listItem);
      });
    });
}

function fermerModalAfficheIngredient() {
  const modale = document.querySelector("#afficher-ingredient");
  modale.style.display = "none";
}



//DarkMode
function obtenirCookieDarkMode() {
  const name = "darkmode=";
  const ca = document.cookie.split(";");
  for (let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == " ") {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length) === "true";
    }
  }
  return false;
}

function cookieDarkMode(activer) {
  const d = new Date();
  const expiration = 30;
  d.setTime(d.getTime() + expiration * 24 * 60 * 60 * 1000);
  const expires = "expires=" + d.toUTCString();
  document.cookie = `darkmode=${activer}; ${expires}`;
  afficherBanniereCookie();
}

function afficherDarkMode() {
  const darkMode = obtenirCookieDarkMode();
  if (darkMode) {
    document.documentElement.style.setProperty("--couleur-primaire", "#2f1818");
    document.documentElement.style.setProperty("--couleur-secondaire", "rgb(94, 102, 106)");
    document.documentElement.style.setProperty("--couleur-tertiaire", "#d1cdc7");
    document.documentElement.style.setProperty("--couleur-quaternaire", "#181a1b");
    document.documentElement.style.setProperty("--couleur-transparente", "rgba(26, 29, 30, 0.7)");
    document.documentElement.style.setProperty("--couleur-constraste", "#F4E9E9");
  } else {
    document.documentElement.style.setProperty("--couleur-primaire", "#F4E9E9");
    document.documentElement.style.setProperty("--couleur-secondaire", "#897c7c");
    document.documentElement.style.setProperty("--couleur-tertiaire", "#000000");
    document.documentElement.style.setProperty("--couleur-quaternaire", "#FFFFFF");
    document.documentElement.style.setProperty("--couleur-transparente", "rgba(255, 255, 255, 0.8)");
    document.documentElement.style.setProperty("--couleur-constraste", "#2f1818");
  }
}

function activerDesactiveDarkMode() {
  let darkmodeActiver = !obtenirCookieDarkMode();
  cookieDarkMode(darkmodeActiver);
  afficherDarkMode();
}

afficherDarkMode();


// Affichage liste des catégories
let btn_affichagecategorie = document.getElementById("btn_affichagecategorie");
let d1 = document.getElementById("d1");
d1.style.display = "none";
btn_affichagecategorie.addEventListener("click", () => {
  if(getComputedStyle(d1).display != "none"){
    d1.style.display = "none";
  } else {
    d1.style.display = "block";
  }
})


// Affichage liste des ingrédients
let btn_affichageingredient = document.getElementById("btn_affichageingredient");
let d2 = document.getElementById("d2");
d2.style.display = "none";
btn_affichageingredient.addEventListener("click", () => {
  if(getComputedStyle(d2).display != "none"){
    d2.style.display = "none";
  } else {
    d2.style.display = "block";
  }
})


//Ajout champs ajout allergène pour création ingrédient

var btn_ajout_allergene = document.getElementById('btn-ajout-allergene');
var conteneur_allergene = document.getElementById('conteneur_allergene');
var champs_allergene = document.getElementById('champs_allergene');

function ajoutAllergene(event) {
  event.preventDefault();
  var nouvelAllergene = champs_allergene.cloneNode(true);
  nouvelAllergene.style.display = "";

  var boutonSupprimer = document.createElement('a');
  boutonSupprimer.textContent = 'Supprimer';
  boutonSupprimer.classList = 'lien-supprimer';

  boutonSupprimer.addEventListener('click', function() {
    conteneur_allergene.removeChild(nouvelAllergene);
  });
  
  nouvelAllergene.appendChild(boutonSupprimer);
  conteneur_allergene.appendChild(nouvelAllergene);
}

btn_ajout_allergene.addEventListener('click', ajoutAllergene);


// Ajout champs ajout d'ingrédient pour création recette

var btn_ajout_ingredient = document.getElementById('btn-ajout-ingredient');
var conteneur_ingredient = document.getElementById('conteneur_ingredient');
var champs_ingredient = document.getElementById('champs_ingredient');

function ajoutIngredient(event) {
  event.preventDefault();
  var nouvelIngredient = champs_ingredient.cloneNode(true);
  nouvelIngredient.style.display = "";

  var boutonSupprimer = document.createElement('a');
  boutonSupprimer.textContent = 'Supprimer';
  boutonSupprimer.classList = 'lien-supprimer';

  boutonSupprimer.addEventListener('click', function() {
    conteneur_ingredient.removeChild(nouvelIngredient);
  });
  
  nouvelIngredient.appendChild(boutonSupprimer);
  conteneur_ingredient.appendChild(nouvelIngredient);
}

btn_ajout_ingredient.addEventListener('click', ajoutIngredient);



//fermerture burger

const burger = document.querySelector(".collapse");
const menu = document.querySelector(".menu-burger")

burger.addEventListener("click", (e) => {
    if(menu.style.visibility == "hidden") {
        menu.style.visibility == "visible"
        console.log(e)
    } else {
        menu.style.visibility == "hidden"
        console.log(e)
    } 
})


// Forum
function activerModeEditionReponseForum(idReponseForum) {
  const reponseTopicForum = document.querySelector('#'+ idReponseForum);

  const cacherElement = reponseTopicForum.querySelector('.forum-edition-cacher');
  const afficherElement = reponseTopicForum.querySelector('.forum-edition-afficher');

  cacherElement.classList.remove('forum-edition-cacher');
  cacherElement.classList.add('forum-edition-afficher');

  afficherElement.classList.remove('forum-edition-afficher');
  afficherElement.classList.add('forum-edition-cacher');
}

function activerModeEditionQuestionForum(idQuestionForum) {
  const reponseTopicForum = document.querySelector('#'+ idReponseForum);

  const cacherElement = reponseTopicForum.querySelector('.forum-edition-cacher');
  const afficherElement = reponseTopicForum.querySelector('.forum-edition-afficher');

  cacherElement.classList.remove('forum-edition-cacher');
  cacherElement.classList.add('forum-edition-afficher');

  afficherElement.classList.remove('forum-edition-afficher');
  afficherElement.classList.add('forum-edition-cacher');
}

var idReponse = undefined;
function suppresionMessage(idReponse2) {
  document.querySelector('#modale-suppression').style="display: block";
  idReponse = idReponse2;
}

function confirmerSuppressionMessage() {
  console.log(idReponse);
  var formData = new FormData();
  formData.append('idReponse', idReponse);

  fetch("core/forumSupprimerReponse.php", {
    method: 'POST',
    body: formData,
  }).then((res) => {
    return res.text()
  }).then((e) => {
    console.log(e);
  })
  idReponse = null;
  location.reload();
  // document.querySelector('#modale-suppression').style="display: none";
}

function fermerModaleSuppresion() {
  document.querySelector('#modale-suppression').style="display: none";
  idReponse = null;
}

// Suppresion question forum
var idQuestion = undefined;
function suppressionQuestion(idQuestion2) {
  document.querySelector('#modale-suppression-topic').style="display: block";
  idQuestion = idQuestion2;
}

function confirmerSuppressionQuestion() {
  var formData = new FormData();
  formData.append('idQuestion', idQuestion);

  fetch("core/forumSupprimerTopic.php", {
    method: 'POST',
    body: formData,
  }).then((res) => {
    return res.text()
  }).then((e) => {
    console.log(e);
  })
  idQuestion = null;
  location.reload();
  // document.querySelector('#modale-suppression-topic').style="display: none";
}

function fermerModaleSuppresionQuestion() {
  document.querySelector('#modale-suppression-topic').style="display: none";
  idQuestion = null;
}


