<div>
    <form id ="avatar-form">
        <input type="hidden" name="couleurPeau" id="couleurPeauInput" value="">
        <input type="hidden" name="couleurCheveux" id="couleurCheveuxInput" value="">
        <input type="hidden" name="coiffure" id="coiffureInput" value="">
        <input type="hidden" name="yeux" id="yeuxInput" value="">
        <input type="hidden" name="accessoire" id="accessoireInput" value="">
        <input type="hidden" name="pilosite" id="pilositeInput" value="">
        <input type="hidden" name="bouche" id="boucheInput" value="">  
    </form>
</div>

<div id="inscriptions-avatar" class="form-inscription">
    
    
        <div id="column_gap">
            <div class="rond-avatar"><a href="#" onclick="changerCouleurCheveux()">Couleur cheveux</a></div>
            <div class="rond-avatar"><a href="#" onclick="changerCoiffure()">Coiffure</a></div>
            <div class="rond-avatar"><a href="#" onclick="changerBouche()">Bouche</a></div>
            <div class="rond-avatar"><a href="#" onclick="changerYeux()">Yeux</a></div>
            <div class="rond-avatar"><a href="#" onclick="changerPilosite()">Pilositée</a></div>
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
            <a onclick="afficherVerifications()"  class="button3">Suivant</a>
        </div>
    
</div>
