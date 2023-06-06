<div id="inscriptions-coordonnees" class="form-inscription formCoordonnees flex-column justify-content-between">
    <div class="champ">
        <input autocomplete="off" type="text" name="lastname" required="required" value="<?= (!empty($_SESSION["data"])) ? $_SESSION["data"]["lastname"] : ""; ?>">
        <label>Nom</label>
    </div>
    <div class="champ">
        <input autocomplete="off" type="text" name="firstname" required="required" value="<?= (!empty($_SESSION["data"])) ? $_SESSION["data"]["firstname"] : ""; ?>">
        <label>Prénom</label>
    </div>
    <div class="champ">
        <input autocomplete="off" type="email" name="email" required="required" value="<?= (!empty($_SESSION["data"])) ? $_SESSION["data"]["email"] : ""; ?>">
        <label>Email</label>
    </div>
    <div class="champ">
        <input autocomplete="off" type="date" name="birthday" required="required" value="<?= (!empty($_SESSION["data"])) ? $_SESSION["data"]["birthday"] : "1971-01-01"; ?>">
        <label>Date de naissance</label>
    </div>
    <div class="champ">
        <input autocomplete="off" type="password" name="pwd" required="required">
        <label>Mot de passe</label>
    </div>
    <div class="champ">
        <input autocomplete="off" type="password" name="pwdConfirm" required="required">
        <label>Confirmation mot de passe</label>
    </div>
    <a disabled onclick="afficherAdressePostal()" type="submit" class="button3">Suivant</a>
</div>