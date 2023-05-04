
<div id="modale-inscription" class="modale-inscription">
    <div class="modale-content-inscription">
        <div class="d-flex justify-content-between">
            <h1 class="h1-inscription">S'inscrire</h1>
            <span class="close" id="close-modale-inscription" onclick="fermerModaleinscription()">&times;</span>
        </div>
        <div class="radio-input">
            <label>
                <input type="radio" id="value-1" name="value-radio" value="value-1">
                <span>Coordonnées</span>
            </label>
            <label>
                <input type="radio" id="value-2" name="value-radio" value="value-2">
                <span>Adresse postale</span>
            </label>
            <label>
                <input type="radio" id="value-3" name="value-radio" value="value-3">
                <span>Avatar</span>
            </label>
            <span class="selection"></span>
        </div>
        <?php if (isset($_SESSION["listOfErrors"])){ ?>
            <div>
                <div class = "alert alert-danger alert-dismissible fade show" role = "alert">
                    <?php 
                    foreach ($_SESSION['listOfErrors'] as $errors){
                        echo "<li>" .$error ."</li>";
                    }
                    unset($_SESSION['listOfErrors']);
                    ?>


                    <button type = "button" class ="btn-close" data-bs-dismiss = "alert" aria-label = "Close"></button>
                </div>
            </div>
        <?php } ?>    

        <div>
            <form class="form" action = "../core/userAdd.php" method = "POST" >
                <div class="champ">
                    <input type="text" class="input-champ" name="firstname" placeholder="Votre prénom" required="required" 
                    value="<?= ( !empty($_SESSION["data"]))?$_SESSION["data"]["firstname"]:""; ?>">
                    
                </div>
                
                <div class="champ">
                    <input type="text" class="input-champ" name="lastname" placeholder="Votre nom" required="required"
                    value="<?= ( !empty($_SESSION["data"]))?$_SESSION["data"]["laststname"]:""; ?>">
                </div>
                
                <div class="champ">
                    <input type="email" class="input-champ" name="email" placeholder="Votre email" required="required"
                    value="<?= ( !empty($_SESSION["data"]))?$_SESSION["data"]["email"]:""; ?>">
                </div>
                
                <div class="champ"><input type="password" class="input-champ" name="pwd" placeholder="Votre mot de passe" required="required"></div>
               
                <div class="champ"><input type="password" class="input-champ" name="pwdConfirm" placeholder="Confirmation" required="required"></div>
                
                <div class="champ"><select name="country" class="form-select">
                <option value="fr" <?= ( !empty($_SESSION["data"]) && $_SESSION["data"]["country"]=="fr")?"selected":""; ?>>France</option>
                <option value="pl" <?= ( !empty($_SESSION["data"]) && $_SESSION["data"]["country"]=="pl")?"selected":""; ?>>Pologne</option>
                <option value="al" <?= ( !empty($_SESSION["data"]) && $_SESSION["data"]["country"]=="al")?"selected":""; ?>>Algérie</option>
                <option value="be" <?= ( !empty($_SESSION["data"]) && $_SESSION["data"]["country"]=="be")?"selected":""; ?>>Belgique</option>
                    </select></div>
                
                    <div class="champ">
                    <input type="date" class="input-champ" name="birthday" required="required"
                    value="<?= ( !empty($_SESSION["data"]))?$_SESSION["data"]["birthday"]:""; ?>">
                </div>
                <div>
                    <input type="checkbox" class="form-check-input" id="cgu" name="cgu" required="required">
                    <label for="cgu" class="form-label">J'accepte les CGUs</label>
                </div>
                <div>
                    <input type="checkbox" class="form-check-input" id="newsletter" name="newsletter">
                    <label for="cgu" class="form-label">Inscription aux newletter</label>
                </div>
                <button class="button3">Suivant</button>
            </form>
        </div>
    </div>
</div>
