<section class="mon-compte">
    <div class="py-5 d-flex flex-column">
        <div class="container py-5">
            <div class="search-bar">
                <h1>Bienvenue <?php echo $_SESSION['pseudo'] ?> !</h1>
                <form id="" class="d-flex row">
                    <div class="col-10 input-form-mon-compte d-flex">
                        <svg width="16px" height="16px">
                            <image height="16px" fill="#DEC7B1" width="16px" href="./assets/images/loupe.svg" />
                        </svg>
                        <input class="input-form-mon-compte" placeholder="Recherchez votre recette" required type="text">
                    </div>
                    <button class="button2  col-2">Recherchez</button>
                </form>
            </div>

            <div class="container py-4">
                <div class="boite">
                    <table class="table">
                        <thead>
                            <tr class="tr-td-research-recette">
                                <th>Référence</th>
                                <th>Nom</th>
                                <th>Catégorie</th>
                                <th>Difficulté</th>
                                <th>Durée</th>
                                <th>Recette</th>
                                <th>Ingredients</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </div>
    </div>
</section>
<section class="section-radis" class="col">
    <img src="assets/images/separateur.png" class="separateur-de-texte-contact">
</section>

<?php 

if($_SESSION['id']) {
    $connect = connectDB();
    $id_utilisateur = $_SESSION['id'];
    $queryPrepared = $connect->prepare("SELECT nom_utilisateur, prenom_utilisateur, pseudo, email, telephone, date_de_naissance, adresse, code_postal, ville FROM MAKISINE_UTILISATEUR WHERE id_utilisateur=:id_utilisateur");
    $queryPrepared->execute(["id_utilisateur" => $id_utilisateur]);
    $utilisateur = $queryPrepared->fetch();
}

?>
<section class="forum">
    <div class="py-5 d-flex flex-column">
        <div class="container py-5">
            <div class="boite d-flex flex-column">
                <h1>Vos données personnelles</h1>
                <form action="./core/userUpdate.php" method="POST" class="d-flex flex-column">
                    <div class="d-flex flex-column my-2">
                        <div class="d-flex flex-row">
                            <label class="d-flex col-6">Pseudo</label>
                            <input class="d-flex col-6" value="<?php echo $utilisateur['pseudo'] ?>" />
                        </div>
                    </div>
                    <div class="d-flex flex-column my-2">
                        <div class="d-flex flex-row">
                            <label class="d-flex col-6">Prénom</label>
                            <input class="d-flex col-6" value="<?php echo $utilisateur['prenom_utilisateur'] ?>" />
                        </div>
                    </div>
                    <div class="d-flex flex-column my-2">
                        <div class="d-flex flex-row">
                            <label class="d-flex col-6">Nom</label>
                            <input class="d-flex col-6" value="<?php echo $utilisateur['nom_utilisateur'] ?>" />
                        </div>
                    </div>
                    <div class="d-flex flex-column my-2">
                        <div class="d-flex flex-row">
                            <label class="d-flex col-6">Email</label>
                            <input class="d-flex col-6" value="<?php echo $utilisateur['email'] ?>" />
                        </div>
                    </div>
                    <div class="d-flex flex-column my-2">
                        <div class="d-flex flex-row">
                            <label class="d-flex col-6">Téléphone</label>
                            <input class="d-flex col-6" value="<?php echo $utilisateur['telephone'] ?>" />
                        </div>
                    </div>
                    <div class="d-flex flex-column my-2">
                        <div class="d-flex flex-row">
                            <label class="d-flex col-6">Date de naissance</label>
                            <input class="d-flex col-6" type="date" value="<?php echo $utilisateur['date_de_naissance'] ?>" />
                        </div>
                    </div>
                    <div class="d-flex flex-column my-2">
                        <div class="d-flex flex-row">
                            <label class="d-flex col-6">Adresse postale</label>
                            <input class="d-flex col-6" value="<?php echo $utilisateur['adresse'] ?>" />
                        </div>
                    </div>
                    <div class="d-flex flex-column my-2">
                        <div class="d-flex flex-row">
                            <label class="d-flex col-6">Code postal</label>
                            <input class="d-flex col-6" value="<?php echo $utilisateur['code_postal'] ?>" />
                        </div>
                    </div>
                    <div class="d-flex flex-column my-2">
                        <div class="d-flex flex-row">
                            <label class="d-flex col-6">Ville</label>
                            <input class="d-flex col-6" value="<?php echo $utilisateur['ville'] ?>" />
                        </div>
                    </div>

                    <button class="button3">Mettre à jour</button>
                </form>
            </div>


        </div>
    </div>
    </div>
</section>