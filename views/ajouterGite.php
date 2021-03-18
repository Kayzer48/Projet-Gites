<?php

include_once 'partials/header.php';

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
                    <select name="zone_geo" class="form-control" id="zone_geo">
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
?>

<?php
/*if (isset($_POST['validateadd'])){
    $gite->confirmajouterGite();

}

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
    $gite->createGite();
    echo 'button pushed';
}*/

include_once 'partials/footer.php';

?>