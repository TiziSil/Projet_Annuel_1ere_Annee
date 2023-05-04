<div id="inscriptions-avatar">
    <form class="form-inscription">
        <div id="column_gap">
            <div class="rond-avatar"><a href="#" onclick="changerCouleurCheveux()">Couleur cheveux</a></div>
            <div class="rond-avatar"><a href="#" onclick="changerCheveux()">Cheveux</a></div>
            <div class="rond-avatar"><a href="#" onclick="changerBouche()">Bouche</a></div>
            <div class="rond-avatar"><a href="#" onclick="changerYeux()">Yeux</a></div>
            <div class="rond-avatar"><a href="#" onclick="changerPilosite()">Pilositer</a></div>
            <div class="rond-avatar"><a href="#" onclick="changerCouleurPeau()">Peau</a></div>
            <div class="rond-avatar"><a href="#" onclick="changerAccessoire()">Accesoires</a></div>
        </div>

        <div class="fleches d-flex flex-row justify-content-center">
            <!-- <div class="fleche-gauche "></div> -->
            <div>
                <svg height="256px" width="256px">
                    <use id="visageSelectionner" href="#visage"></use>
                    <use id="cheveuxSelectionner" href="#yeux"></use>
                    <use id="boucheSelectionner" href="#none"></use>
                    <use id="pilositeSelectionner" href="#none"></use>
                    <use id="yeuxSelectionner" href="#yeux"></use>
                    <use id="accesoireSelectionner" href="#none"></use>
                </svg>
            </div>
            <!-- <div class="fleche-droite"></div> -->
        </div>

        <div class="cgu-et-bouton d-flex flex-column">
            <button class="button3">Suivant</button>
        </div>
    </form>
</div>