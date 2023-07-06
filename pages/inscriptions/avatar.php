<div id="inscriptions-avatar">
    <div class="form-inscription">
        <div id="column_gap">
            <div class="rond-avatar"><a href="#" onclick="changerCouleurCheveux()">Couleur cheveux</a></div>
            <div class="rond-avatar"><a href="#" onclick="changerCoiffure()">Coiffure</a></div>
            <div class="rond-avatar"><a href="#" onclick="changerBouche()">Bouche</a></div>
            <div class="rond-avatar"><a href="#" onclick="changerYeux()">Yeux</a></div>
            <div class="rond-avatar"><a href="#" onclick="changerPilosite()">Pilosité</a></div>
            <div class="rond-avatar"><a href="#" onclick="changerCouleurPeau()">Peau</a></div>
            <div class="rond-avatar"><a href="#" onclick="changerAccessoire()">Lunettes</a></div>
        </div>

        <div class="fleches d-flex flex-row justify-content-center">
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
                <input class="d-none" id="inputCouleurVisage" name="couleurVisage" />
                <input class="d-none" id="inputCouleurCheveux" name="couleurCheveux" />
                <input class="d-none" id="inputCheveuxSelectionne" name="cheveuxSelectionne" />
                <input class="d-none" id="inputBoucheSelectionne" name="boucheSelectionne" />
                <input class="d-none" id="inputPilositeSelectionne" name="pilositeSelectionne" />
                <input class="d-none" id="inputYeuxSelectionne" name="yeuxSelectionne" />
                <input class="d-none" id="inputAccesoireSelectionne" name="accesoireSelectionne" />
            </div>
        </div>

        <div class="cgu-et-bouton d-flex flex-column">
            <a onclick="afficherVerifications()" class="button3">Suivant</a>
        </div>
    </div>
</div>