<?php
session_start();
ob_start();
require 'views/models/GitesModels.php';

$allGites = new GitesModels();

if(isset($_GET['url'])){
$url = $_GET['url'];
}else{
$url = "accueil";
}

if(!isset($_GET['url']) || empty($_GET['url'])){

}
/*
if($_GET['url'] === ''){
$url = 'accueil';
}*/


if($url === 'accueil'){
require 'views/accueil.php';

}elseif ($url === ''){
    require 'views/accueil.php';

}elseif ($url === 'connexion'){
require 'views/connexion.php';

}elseif ($url === 'deconnexion'){
require 'views/deconnexion.php';

}elseif ($url === 'detailsGite'){
    require 'views/detailsGite.php';

}elseif ($url === 'detailsUserGite'){
    require 'views/detailsUserGite.php';

}elseif ($url === 'Recherche'){
    require 'views/Recherche.php';

}elseif ($url === 'searchGite'){
    require 'views/searchGite.php';

}elseif ($url === 'searchGiteAdmin'){
    require 'views/searchGiteAdmin.php';

}elseif ($url === 'reservation'){
    require 'views/reservation.php';

}elseif (isset($_SESSION['connecter']) && $_SESSION['connecter'] === true && $url === "admin"){
require 'views/admin.php';

}elseif ($url === 'ajouterGite'){
    require 'views/ajouterGite.php';

}elseif ($url === 'ConfirmajouterGite'){
    require 'views/ConfirmajouterGite.php';

}elseif ($url === "updateGite"){
    require 'views/updateGite.php';

}elseif ($url === "ConfirmupdateGite"){
    require 'views/ConfirmupdateGite.php';

}elseif ($url === "deleteGite"){
    require 'views/deleteGite.php';

}elseif ($url === "ConfirmdeleteGite"){
    require 'views/ConfirmdeleteGite.php';


}elseif($url !=  '#:[\w]+)#'){
require 'views/error404.php';
}

$content = ob_get_clean();
require '_layout.php';
