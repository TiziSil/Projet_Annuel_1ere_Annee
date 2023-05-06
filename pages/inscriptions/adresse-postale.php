<div id="inscriptions-adresse">
    <form class="form-inscription d-flex flex-column justify-content-between" action="Projet_Annuel_1ere_Annee/core/userAdd.php" method="POST">
        <div class="champ">
            <input type="text" class="input-champ" name="adress" required="required" value="">
            <label>Adresse</label>
        </div>
        <div class="champ">
            <input type="number" class="input-champ" name="codepostal" required="required">
            <label>Code postal</label>
        </div>
        <div class="champ">
            <input type="text" class="input-champ" name="rue" required="required">
            <label>Ville</label>
        </div>
        <div class="champ">
            <select id="pays-inscription" onchange="listePays()" name="country" class="form-select-makisine">
                <option value="fr">France</option>
                <option value="it">Italie</option>
                <option value="pt">Portugal</option>
                <option value="pl">Pologne</option>
                <option value="es">Espagne</option>
                <option value="be">Belgique</option>
                <option value="">Autre</option>
            </select>
        </div>
        <div class="champ" id="autre-pays">
            <input type="text" class="input-champ" name="autre">
            <label>Autre pays</label>
        </div>
        <a class="button3" onclick="afficherAvatar()">Suivant</a>
    </form>
</div>