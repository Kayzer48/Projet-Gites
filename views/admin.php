<?php
$email = $_SESSION['email'];
$title = 'Admin';
require_once 'models/GitesModels.php';

?>
<div class="container">
<nav class="navbar navbar-light mt-5">

    <form class="form-inline" method="post" action="searchGiteAdmin">
        <input class="form-control mr-sm-2" type="search" placeholder="ex: Gite Grenoble" aria-label="Search" name="search">
        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Rechercher</button>
    </form>
</nav>
    <div class="container mt-lg-5">
        <div class="card w-75">
            <div class="card-body text-white bg-primary">
                <h5 class="card-title">Bonjour à vous, <?php echo $email ?></h5>
                <p class="card-text">Vous êtes bien connecté avec l'email <?php echo $email; ?></p>
                <a href="ajouterGite" class="btn  btn-outline-light">Ajouter un Gite</a>
            </div>
        </div>
    </div>

        <?php
        $adminGites = new GitesModels();
        $adminGites->getAllGitesAdmin();
        ?>

    </div>

