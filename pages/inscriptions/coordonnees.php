<div id="inscriptions-coordonnees" class="form-inscription">

    <form>
        <div class="champ">
            <input autocomplete="off" type="text" name="firstname" required="required" value="<?= (!empty($_SESSION["data"])) ? $_SESSION["data"]["firstname"] : ""; ?>">
            <label>Prénom</label>
        </div>
        <div class="champ">
            <input autocomplete="off" type="text" name="lastname" required="required" value="<?= (!empty($_SESSION["data"])) ? $_SESSION["data"]["lastname"] : ""; ?>">
            <label>Nom</label>
        </div>
        <div class="champ">
            <input autocomplete="off" type="text" name="pseudo" required="required" value="<?= (!empty($_SESSION["data"])) ? $_SESSION["data"]["pseudo"] : ""; ?>">
            <label>Pseudo</label>
        </div>
        <div class="champ">
            <input autocomplete="off" type="tel" name="telephone" required="required" value="<?= (!empty($_SESSION["data"])) ? $_SESSION["data"]["lastname"] : ""; ?>">
            <label>Téléphone</label>
        </div>
        <div class="champ">
            <input autocomplete="off" type="email" name="email" required="required" value="<?= (!empty($_SESSION["data"])) ? $_SESSION["data"]["email"] : ""; ?>">
            <label>Email</label>
        </div>
        <div class="champ">
            <input autocomplete="off" type="date" value="1979-01-01" name="birthday" required="required" value="<?= (!empty($_SESSION["data"])) ? $_SESSION["data"]["birthday"] : ""; ?>">
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

<!-- <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pseudo = $_POST['pseudo'];
            $password = $_POST['pwd'];
            $isPseudoUsed = false;

            if ($isPseudoUsed) {
                echo "Ce pseudo est déjà utilisé. Veuillez en choisir un autre, s'il vous plait.";
                exit;
            }
            if (!preg_match("/[!@#$%^&*()\-_=+{};:,<.>]/", $password)) {
                echo "Le mot de passe doit contenir au moins un caractère spécial.";
                exit;
            }
        }
        ?> -->