<div id="inscriptions-avatar">
    <form class="form-inscription" action="Projet_Annuel_1ere_Annee/core/userAdd.php" method="POST">
        <div id="column_gap">
            <div class="rond-avatar"><a href="#" onclick="changerCouleurCheveux()">Couleur cheveux</a></div>
            <div class="rond-avatar"><a href="#" onclick="changerCoiffure()">Coiffure</a></div>
            <div class="rond-avatar"><a href="#" onclick="changerBouche()">Bouche</a></div>
            <div class="rond-avatar"><a href="#" onclick="changerYeux()">Yeux</a></div>
            <div class="rond-avatar"><a href="#" onclick="changerPilosite()">Pilositer</a></div>
            <div class="rond-avatar"><a href="#" onclick="changerCouleurPeau()">Peau</a></div>
            <div class="rond-avatar"><a href="#" onclick="changerAccessoire()">Lunettes</a></div>
        </div>

        <div class="fleches d-flex flex-row justify-content-center">
            <!-- <div class="fleche-gauche "></div> -->
            <div>
                <svg height="256px" width="256px">
                    <use id="couleurVisage" href="#visage"></use>
                    <use id="couleurCheveux" href="#couleurCheveux"></use>
                    <use id="cheveuxSelectionne" href="#cheveux"></use>
                    <use id="boucheSelectionne" href="#bouche"></use>
                    <use id="pilositeSelectionne" href="#none"></use>
                    <use id="yeuxSelectionne" href="#yeux"></use>
                    <use id="accesoireSelectionne" href="#none"></use>
                </svg>
            </div>
            <!-- <div class="fleche-droite"></div> -->
        </div>

        <div class="cgu-et-bouton d-flex flex-column">
            <a onclick="afficherVerifications()" class="button3">Suivant</a>
        </div>
    </form>
</div>