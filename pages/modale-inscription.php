<div id="modale-inscription" class="modale-inscription">
    <div class="modale-content-inscription">
        <div class="d-flex justify-content-between">
            <h1 class="h1-inscription">S'inscrire</h1>
            <span class="close" id="close-modale-inscription" onclick="fermerModaleinscription()">&times;</span>
        </div>
        <div class="radio-input fil-ariane">
            <label>
                <input onclick="afficherCoordonnees()" checked="checked" type="radio" id="value-1" name="value-radio" value="value-1">
                <span>Coordonnées</span>
            </label>
            <label>
                <input onclick="afficherAdressePostal()" type="radio" id="value-2" name="value-radio" value="value-2">
                <span>Adresse postale</span>
            </label>
            <label>
                <input onclick="afficherAvatar()" type="radio" id="value-3" name="value-radio" value="value-3">
                <span>Avatar</span>
            </label>
            <label>
                <input onclick="afficherVerifications()" type="radio" id="value-4" name="value-radio" value="value-4">
                <span>Vérifications</span>
            </label>
            <!-- <span class="selection"></span> -->
        </div>
        <div class="content-inscription-forms">
            <?php
            include 'inscriptions/coordonnees.php';
            include 'inscriptions/adresse-postale.php';
            include 'inscriptions/avatar.php';
            include 'inscriptions/verifications.php';
            ?>
        </div>
    </div>
</div>