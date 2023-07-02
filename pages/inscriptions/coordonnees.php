<div id="inscriptions-coordonnees" class="form-inscription formCoordonnees flex-column justify-content-between">
    <div class="champ">
        <input autocomplete="off" type="text" name="lastname" required="required"  onkeyup="validerLastName()"  value="<?= (!empty($_SESSION["data"])) ? $_SESSION["data"]["lastname"] : ""; ?>">
        <label>Nom</label>
        <div class="error"></div>
    </div>
    <div class="champ">
        <input autocomplete="off" type="text" name="firstname" required="required"  onkeyup="validerFirstname()"  value="<?= (!empty($_SESSION["data"])) ? $_SESSION["data"]["firstname"] : ""; ?>">
        <label>Prénom</label>
        <div class="error"></div>
    </div>
    <div class="champ">
        <input autocomplete="off" type="email" name="email" required="required"  onkeyup="validerMail()"  value="<?= (!empty($_SESSION["data"])) ? $_SESSION["data"]["email"] : ""; ?>">
        <label>Email</label>
        <div class="error"></div>
    </div>
    <div class="champ">
        <input autocomplete="off" type="date" name="birthday" required="required" value="<?= (!empty($_SESSION["data"])) ? $_SESSION["data"]["birthday"] : "1971-01-01"; ?>">
        <label>Date de naissance</label>
        <div class="error"></div>
    </div>
    <div class="champ">
        <input autocomplete="off" type="password" name="pwd" required="required"  onkeyup="validerMotDePasse()" >
        <label>Mot de passe</label>
        <div class="error"></div>
    </div>
    <div class="champ">
        <input autocomplete="off" type="password" name="pwdConfirm" required="required"  onkeyup="validerMotDePasseConfirmation()" >
        <label>Confirmation mot de passe</label>
        <div class="error"></div>
    </div>
    <a disabled onclick="afficherAdressePostal()" type="submit" class="button3">Suivant</a>
</div>
