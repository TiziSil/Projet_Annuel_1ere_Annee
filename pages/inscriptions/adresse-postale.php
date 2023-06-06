<div id="inscriptions-adresse" class="form-inscription">
    <div class="champ">
        <input autocomplete="off" type="text" name="pseudo" required="required" value="<?= (!empty($_SESSION["data"])) ? $_SESSION["data"]["pseudo"] : ""; ?>">
        <label>Pseudo</label>
    </div>
    <div class="champ">
        <input autocomplete="off" type="tel" name="telephone" required="required" value="<?= (!empty($_SESSION["data"])) ? $_SESSION["data"]["lastname"] : ""; ?>">
        <label>Téléphone</label>
    </div>
    <div class="champ">
        <input type="text" class="input-champ" name="address" required="required" value="<?= (!empty($_SESSION["data"])) ? $_SESSION["data"]["address"] : ""; ?>">
        <label>Adresse</label>
    </div>
    <div class="champ">
        <input type="number" class="input-champ" name="codepostal" required="required" value="<?= (!empty($_SESSION["data"])) ? $_SESSION["data"]["codepostal"] : ""; ?>">
        <label>Code postal</label>
    </div>
    <div class="champ">
        <input type="text" class="input-champ" name="ville" required="required" value="<?= (!empty($_SESSION["data"])) ? $_SESSION["data"]["ville"] : ""; ?>">
        <label>Ville</label>
    </div>
    <div class="champ">
        <select id="pays-inscription" onchange="listePays()" name="country" class="form-select-makisine">
            <option disabled selected="selected" value=""></option>
            <option value="fr" <?= (!empty($_SESSION["data"]) && $_SESSION["data"]["country"] == "fr") ? "selected" : ""; ?>>France</option>
            <option value="it" <?= (!empty($_SESSION["data"]) && $_SESSION["data"]["country"] == "it") ? "selected" : ""; ?>>Italie</option>
            <option value="pt" <?= (!empty($_SESSION["data"]) && $_SESSION["data"]["country"] == "pt") ? "selected" : ""; ?>>Portugal</option>
            <option value="pl" <?= (!empty($_SESSION["data"]) && $_SESSION["data"]["country"] == "pl") ? "selected" : ""; ?>>Pologne</option>
            <option value="es" <?= (!empty($_SESSION["data"]) && $_SESSION["data"]["country"] == "es") ? "selected" : ""; ?>>Espagne</option>
            <option value="be" <?= (!empty($_SESSION["data"]) && $_SESSION["data"]["country"] == "be") ? "selected" : ""; ?>>Belgique</option>
            <option value="xx" <?= (!empty($_SESSION["data"]) && $_SESSION["data"]["country"] == "xx") ? "selected" : ""; ?>>Autre</option>
        </select>
    </div>
    <a class="button3" onclick="afficherAvatar()">Suivant</a>
</div>