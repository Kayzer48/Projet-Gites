<?php
$majGite = new GitesModels();
?>


<?php
$majGite->ConfirmupdateGite();

//Gestion upload image
/*if(isset($_FILES['img_gite'])){
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
}*/
/*
var_dump($_POST['nom_gite']);
var_dump($_POST['description_gite']);
var_dump($_POST['img_gite']);
var_dump($_POST['nbr_chambre']);
var_dump($_POST['nbr_sdb']);
var_dump($_POST['zone_geo']);
var_dump($_POST['prix']);
var_dump($_POST['disponible']);
var_dump($_POST['date_arrivee']);
var_dump($_POST['date_depart']);
var_dump($_POST['type_gite']);
var_dump($_FILES);

*/

?>
