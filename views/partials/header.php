<?php
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <title>Projet Gites</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="index.php"><b>Atlas Gîte</b></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01"
            aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="accueil">Accueil
                    <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item">
                <?php
                //si session connecter retourne la page d'accueil
                if(isset($_SESSION['connecter']) && $_SESSION['connecter'] === true){
                    ?>

            <a class="nav-link" href="admin">ADMINISTRATION</a>

                    <?php
                }else{
                    ?>
                    <a class="nav-link" href="#"></a>
                    <?php
                }
                ?>
            </li>
        </ul>
    </div>
    <form class="form-inline my-2 my-lg-0">
        <?php
        if(isset($_SESSION['connecter']) && $_SESSION['connecter'] === true){
            ?>
            <a class="nav-link btn btn-sm  btn-outline-light" href="deconnexion">DECONNEXION</a>
            <?php
        }else{
            ?>
            <a class="nav-link btn btn-sm btn-outline-light" href="connexion">CONNEXION</a>
            <?php
        }
        ?>
    </form>
</nav>
