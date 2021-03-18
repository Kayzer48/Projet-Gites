<?php
$title = 'Ajouter';
$gite = new GitesModels();

?>

    <div class="container mt-5 col-lg-4">
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="Nom du gite">Nom Du Gite</label>
                <input type="text" class="form-control" name="nom_gite">
            </div>
            <div class="form-group">
                <label for="Description" class="form-label">Description</label>
                <textarea class="form-control" name="description_gite" rows="3"></textarea>
            </div>
            <div>
                <label for="image">Ajouter Image</label>
                <br>
              <input type="file" name="img_gite">
            </div>
            <div class="form-group">
                <label for="prix" class="form-label">Prix</label>
                <input type="number" class="form-control" name="prix">
            </div>
            <div class="form-group">
                <label for="nbr_chambre" class="form-label">Nbr de chambre</label>
                <select class="form-control" name="nbr_chambre">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                </select>
            </div>
            <div class="form-group">
                <label for="nbr_sdb" class="form-label">Nbr de sdb</label>
                <select class="form-control" name="nbr_sdb">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                </select>
                <div class="form-group">
                    <label for="disponible">Disponibilité</label>
                    <select name="disponible" class="form-control" id="disponible">
                        <option value="0">OUI</option>
                        <option value="1">NON</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="zone_geo">Zone</label>
                    <select name="zone_geo" class="form-control" id="zone_ge">
                        <option>01 - Ain - Bourg-en-bresse</option>
                        <option></option>
                        <option>02 - Aisne - Laon</option>
                        <option></option>
                        <option>03 - Allier - Moulins</option>
                        <option></option>
                        <option>04 - Alpes-de-Haute-Provence - Digne-les-bains</option>
                        <option></option>
                        <option>05 - Hautes-alpes - Gap</option>
                        <option></option>
                        <option>06 - Alpes-maritimes - Nice</option>
                        <option></option>
                        <option>07 - Ardèche - Privas</option>
                        <option></option>
                        <option>08 - Ardennes - Charleville-mézières</option>
                        <option></option>
                        <option>09 - Ariège - Foix</option>
                        <option></option>
                        <option>10 - Aube - Troyes</option>
                        <option></option>
                        <option>11 - Aude - Carcassonne</option>
                        <option></option>
                        <option>12 - Aveyron - Rodez</option>
                        <option></option>
                        <option>13 - Bouches-du-Rhône - Marseille</option>
                        <option></option>
                        <option>14 - Calvados - Caen</option>
                        <option></option>
                        <option>15 - Cantal - Aurillac</option>
                        <option></option>
                        <option>16 - Charente - Angoulême</option>
                        <option></option>
                        <option>17 - Charente-maritime - La rochelle</option>
                        <option></option>
                        <option>18 - Cher - Bourges</option>
                        <option></option>
                        <option>19 - Corrèze - Tulle</option>
                        <option></option>
                        <option>2A - Corse-du-sud - Ajaccio</option>
                        <option></option>
                        <option>2B - Haute-Corse - Bastia</option>
                        <option></option>
                        <option>21 - Côte-d'Or - Dijon</option>
                        <option></option>
                        <option>22 - Côtes-d'Armor - Saint-brieuc</option>
                        <option></option>
                        <option>23 - Creuse - Guéret</option>
                        <option></option>
                        <option>24 - Dordogne - Périgueux</option>
                        <option></option>
                        <option>25 - Doubs - Besançon</option>
                        <option></option>
                        <option>26 - Drôme - Valence</option>
                        <option></option>
                        <option>27 - Eure - Évreux</option>
                        <option></option>
                        <option>28 - Eure-et-loir - Chartres</option>
                        <option></option>
                        <option>29 - Finistère - Quimper</option>
                        <option></option>
                        <option>30 - Gard - Nîmes</option>
                        <option></option>
                        <option>31 - Haute-garonne - Toulouse</option>
                        <option></option>
                        <option>32 - Gers - Auch</option>
                        <option></option>
                        <option>33 - Gironde - Bordeaux</option>
                        <option></option>
                        <option>34 - Hérault - Montpellier</option>
                        <option></option>
                        <option>35 - Ille-et-vilaine - Rennes</option>
                        <option></option>
                        <option>36 - Indre - Châteauroux</option>
                        <option></option>
                        <option>37 - Indre-et-loire - Tours</option>
                        <option></option>
                        <option>38 - Isère - Grenoble</option>
                        <option></option>
                        <option>39 - Jura - Lons-le-saunier</option>
                        <option></option>
                        <option>40 - Landes - Mont-de-marsan</option>
                        <option></option>
                        <option>41 - Loir-et-cher - Blois</option>
                        <option></option>
                        <option>42 - Loire - Saint-étienne</option>
                        <option></option>
                        <option>43 - Haute-loire - Le puy-en-velay</option>
                        <option></option>
                        <option>44 - Loire-atlantique - Nantes</option>
                        <option></option>
                        <option>45 - Loiret - Orléans</option>
                        <option></option>
                        <option>46 - Lot - Cahors</option>
                        <option></option>
                        <option>47 - Lot-et-garonne - Agen</option>
                        <option></option>
                        <option>48 - Lozère - Mende</option>
                        <option></option>
                        <option>49 - Maine-et-loire - Angers</option>
                        <option></option>
                        <option>50 - Manche - Saint-lô</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="date_arrivee">Date d'arrivée : </label>
                    <input type="date" id="date_arrivee" name="date_arrivee">
                </div>

                <div class="form-group">
                    <label for="date_depart">Date de départ : </label>
                    <input type="date" id="date_depart" name="date_depart">
                </div>

                <div class="form-group">
                    <label for="type_gite" class="form-label">Type gite</label>
                    <select class="form-control" name="type_gite">
                        <option value="1">Maison</option>
                        <option value="2">Villa</option>
                        <option value="3">Appartement</option>
                        <option value="4">Chalet</option>
                        <option value="5">Camping</option>
                        <option value="6">Hotel</option>
                        <option value="7">Igloo</option>
                        <option value="8">Yourt</option>
                    </select>
                </div>
                <button name="validateadd" type="submit" class="btn btn-primary">Ajouter</button>

        </form>
    </div>
<?php
if(isset($_FILES['img_gite'])){
$uploaddir = 'assets/img/';
$img_gite = $uploaddir . basename($_FILES['img_gite']['name']);
$_POST['img_gite'] = $img_gite;
if(move_uploaded_file($_FILES['img_gite']['tmp_name'], $img_gite)){

    echo '<p class="alert-success">Le fichier est valide et à été téléchargé avec succès !</p>';
}else{
    echo '<p class="alert-danger">Une erreur s\'est produite, le fichier n\'est pas valide !</p>';
}
}else{
    echo "<p class='alert-warning p-2'>Merci de respecter le format d'image valide : png, svg, jpg, jpeg, webp !</p>";
}

if(isset($_POST['validateadd'])){
    $gite->confirmajouterGite();

}