<div id="modale-inscription" class="modale-inscription">
    <form action="core/userAdd.php" method="POST">
        <div class="modale-content-inscription">
            <div class="d-flex justify-content-between">
                <h1 class="h1-inscription">S'inscrire</h1>
                <span class="close" id="close-modale-inscription" onclick="fermerModaleinscription()">&times;</span>
            </div>
            <div class="radio-input fil-ariane">
                <li onclick="afficherCoordonnees()">
                    <a id="inscription-value-1" name="value-radio" value="value-1">Infos Persos</a>
                </li>
                <li onclick="afficherAdressePostal()">
                    <a id="inscription-value-2" name="value-radio" value="value-2">Coordonnées</a>
                </li>
                <li onclick="afficherAvatar()">
                    <a id="inscription-value-3" name="value-radio" value="value-3">Avatar</a>
                </li>
                <li onclick="afficherVerifications()">
                    <a id="inscription-value-4" name="value-radio" value="value-4">Vérifications</a>
                </li>
            </div>
            <div class="content-inscription-forms">
                <?php
                include './pages/inscriptions/coordonnees.php';
                include './pages/inscriptions/adresse-postale.php';
                include './pages/inscriptions/avatar.php';
                include './pages/inscriptions/verifications.php';
                ?>
            </div>
        </div>
    </form>
</div>