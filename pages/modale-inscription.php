
<div id="modale-inscription" class="modale-inscription">
<<<<<<< HEAD
    <div class="modale-content-inscription">
        <div class="d-flex justify-content-between">
            <h1 class="h1-inscription">S'inscrire</h1>
            <span class="close" id="close-modale-inscription" onclick="fermerModaleinscription()">&times;</span>
        </div>
        <div class="radio-input fil-ariane">
            <li>
                <a onclick="afficherCoordonnees()" checked="checked" type="radio" id="inscription-value-1" name="value-radio" value="value-1">Coordonnées</a>

            </li>
            <li>
                <a onclick="afficherAdressePostal()" type="radio" id="inscription-value-2" name="value-radio" value="value-2">Adresse postale</a>
            </li>
            <li>
                <a onclick="afficherAvatar()" type="radio" id="inscription-value-3" name="value-radio" value="value-3">Avatar</a>

            </li>
            <li>
                <a onclick="afficherVerifications()" type="radio" id="inscription-value-4" name="value-radio" value="value-4">Vérifications</a>

            </li>
            <!-- <span class="selection"></span> -->
=======
    <form action="/ProjetAnnuel/core/userAdd.php" method="POST">
        <div class="modale-content-inscription">
            <div class="d-flex justify-content-between">
                <h1 class="h1-inscription">S'inscrire</h1>
                <span class="close" id="close-modale-inscription" onclick="fermerModaleinscription()">&times;</span>
            </div>
            <div class="radio-input fil-ariane">
                <label>
                    <input onclick="afficherCoordonnees()" checked="checked" type="radio" id="inscription-value-1" name="value-radio" value="value-1">
                    console.log("🚀 ~ file: modale-inscription.php:10 ~ onclick:", onclick)
                <span>Coordonnées</span>
                </label>
                <label>
                    <input onclick="afficherAdressePostal()" type="radio" id="inscription-value-2" name="value-radio" value="value-2">
                    <span>Adresse postale</span>
                </label>
                <label>
                    <input onclick="afficherAvatar()" type="radio" id="inscription-value-3" name="value-radio" value="value-3">
                    <span>Avatar</span>
                </label>
                <label>
                    <input onclick="afficherVerifications()" type="radio" id="inscription-value-4" name="value-radio" value="value-4">
                    <span>Vérifications</span>
                </label>
                <!-- <span class="selection"></span> -->
            </div>
            <div class="content-inscription-forms">
                <?php
                include './pages/inscriptions/coordonnees.php';
                include './pages/inscriptions/adresse-postale.php';
                include './pages/inscriptions/avatar.php';
                include './pages/inscriptions/verifications.php';
                ?>
            </div>
>>>>>>> 4fee3288315c7dd20e02a6ebc77ce600058645df
        </div>
    </form>
</div>