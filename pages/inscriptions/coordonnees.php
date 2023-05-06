<div id="inscriptions-coordonnees" action="Projet_Annuel_1ere_Annee/core/userAdd.php" method="POST">
    <form class="form-inscription">
        <div class="champ">
            <input autocomplete="off" type="text" name="firstname" required="required" value="">
            <label>Prénom</label>
        </div>
        <div class="champ">
            <input autocomplete="off" type="text" name="lastname" required="required">
            <label>Nom</label>
        </div>
        <div class="champ">
            <input autocomplete="off" type="email" name="email" required="required">
            <label>Email</label>
        </div>
        <div class="champ">
            <input autocomplete="off" type="date" value="1879-01-01" name="birthday" required="required">
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
        <a onclick="afficherAdressePostal()" class="button3">Suivant</a>
    </form>
</div>