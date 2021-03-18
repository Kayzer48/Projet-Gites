<?php

require 'Database.php';

class GitesModels extends Database
{
    private $nom_gite;
    private $description_gite;
    private $img_gite;
    private $nbr_chambre;
    private $nbr_sdb;
    private $zone_geo;
    private $prix;
    private $disponible;
    private $date_arrivee;
    private $date_depart;
    private $type_gite;

// Montrer tous les gites pour l'admin
    public function getAllGitesAdmin()
{
    $db = $this->connectPDO();
    $stmt = $db->prepare("SELECT * FROM `gites`INNER JOIN category_gites ON gites.gite_category = category_gites.id_category");
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    ?>
    <div class="container text-center mt-5">
        <div class="row ">
            <?php
            foreach ($products as $row):
                ?>
                <div class="col-lg-4 d-flex align-items-stretch">
                    <div class="card mt-3">
                        <img class="img-fluid" src="<?php echo $row['img_gite'] ?>"
                             alt="<?php echo $row['nom_gite'] ?>" title="<?php echo $row['nom_gite']; ?>">
                        <h5 class="font-weight-bold mt-3"><?php echo $row['nom_gite'] ?></h5>
                        <h5 class="font-weight-bold mt-3">Prix : <?php echo $row['prix'] ?> EUR</h5>
                        <h5 class="font-weight-bold mt-3">Type de logement : <?php echo $row['type'] ?></h5>
                        <a class="btn btn-primary p-3 m-2 font-weight-bold"
                           href="detailsGite&id=<?= $row['id'] ?>">Détails</a>
                        <a class="btn btn-warning p-3 m-2 font-weight-bold"
                           href="updateGite&id=<?= $row['id'] ?>">Mettre à jour</a>
                        <a class="btn btn-danger p-3 m-2 font-weight-bold"
                           href="deleteGite&id=<?= $row['id'] ?>">Supprimer</a>

                    </div>
                </div>
            <?php
            endforeach; ?>
        </div>
    </div>
    <?php
}

// Montrer tous les gites pour l'utilisateur
    public function getAllGitesUser()
{
    $db = $this->connectPDO();
    $stmt = $db->prepare("SELECT * FROM `gites` WHERE disponible=1");
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    ?>
    <div class="container text-center mt-5">
        <div class="row ">
            <?php
            foreach ($products as $row):
                ?>
                <div class="col-lg-4 d-flex align-items-stretch">
                    <div class="card mt-3">
                        <img class="img-fluid" src="<?php echo $row['img_gite'] ?>"
                             alt="<?php echo $row['nom_gite'] ?>" title="<?php echo $row['nom_gite']; ?>">
                        <h5 class="font-weight-bold mt-3"><?php echo $row['nom_gite'] ?></h5>
                        <h5 class="font-weight-bold mt-3">Prix : <?php echo $row['prix'] ?> EUR</h5>
                        <a class="btn btn-primary p-3 m-2 font-weight-bold"
                           href="reservation&id=<?= $row['id'] ?>">Reserver</a>
                        <a class="btn btn-warning p-3 m-2 font-weight-bold"
                           href="detailsUserGite&id=<?= $row['id'] ?>">Plus d'infos</a>
                    </div>
                </div>
            <?php
            endforeach; ?>
        </div>
    </div>
    <?php
}

// Montrer les détails d'un gîte pour un admin
    public function detailsGite(){
    $db=$this->connectPDO();
    $req = $db->prepare("SELECT * FROM gites INNER JOIN category_gites  ON gites.gite_category = category_gites.id_category INNER JOIN departement ON gites.zone_geo = departement.departement_id WHERE gites.id = ? ");
    $id = $_GET['id'];
    $req->bindParam(1, $id);
    $req->execute();
    $row = $req->fetch();
    ?>
    <div class="container text-center mt-5">
        <div>
            <div class="col-lg-4 d-flex align-items-stretch">
                <div class="card mt-3">
                    <img class="img-fluid" src="<?=$row['img_gite'] ?>" alt="Card image cap" >
                    <div class="card-body ">
                        <h5 class="card-title "><b><?= $row['nom_gite'] ?></b></h5>
                        <p class="card-text"><b>Zone géographique:</b> <?= $row['zone_geo'] ?></p>
                        <p class="card-text"><b>Type:</b> <?= $row['type'] ?></p>
                        <p class="card-text"><b>Description: </b><?= $row['description_gite'] ?></p>
                        <p class="card-text">Il y a <b><?= $row['nbr_chambre'] ?> chambre(s).</b></p>
                        <p class="card-text">Il y a <b><?= $row['nbr_sdb'] ?> salle(s) de bains.</b></p>
                        <?php
                        $dispo = $row['disponible'];
                        if($dispo == false){
                            $dispo =  "NON";
                        }else{
                            $dispo = "OUI";
                        }
                        ?>
                        <p class="card-text"><b>Disponible:</b> <?= $dispo ?> </p>
                        <?php
                        $date_a = new DateTime($row['date_arrivee']);
                        $date_d = new DateTime($row['date_depart']);
                        ?>
                        <p class="card-text"><b>Date d'arrivée:</b> <?= $date_a->format('d-m-Y à H:i:s')?></p>
                        <p class="card-text"><b>Date de départ:</b> <?= $date_d->format('d-m-Y à H:i:s') ?></p>
                        <p class="card-text">La location a la semaine du logement est de<b>  <?= $row['prix'] ?> € </b></p>
                        <a href="updateGite&id=<?=$row ['id']?>" class="btn btn-warning">Mettre à jour</a>
                        <a href="deleteGite&id=<?=$row ['id']?>" class="btn btn-danger">Supprimer</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
}

// Montrer les détails d'un gîte pour un user
    public function detailsUserGite(){
    $db = $this->connectPDO();
        $req = $db->prepare("SELECT * FROM gites INNER JOIN category_gites  ON gites.gite_category = category_gites.id_category INNER JOIN departement ON gites.zone_geo = departement.departement_id WHERE gites.id = ?  ");
        $id = $_GET['id'];
        $req->bindParam(1, $id);
        $req->execute();
        $res = $req->fetch();
        ?>
        <div>
            <div class="row mt-5">
                <div class="col-6">
                    <img width="100%" src="<?= $res['img_gite'] ?>" alt="<?= $res['nom_gite'] ?>" title="<?= $res['nom_gite'] ?>"/>
                </div>
                <div class="col-6">
                    <p><b>Nom du gite: </b><?= $res['nom_gite'] ?></p>
                    <p><b>Type: </b> <?= $res['type'] ?></p>
                    <p class="card-text"><b>Description : </b></p>
                    <p><?= $res['description_gite'] ?></p>
                    <p><b>Nombre de chambre : </b><b><?= $res['nbr_chambre'] ?></b></p>
                    <p><b>Nombre de salle de bains : </b><b><?= $res['nbr_sdb'] ?></b></p>
                    <p><b>Zone géographique : </b><b><?= $res['zone_geo'] ?></b></p>
                    <p><b>Prix à la semaine : </b><b><?= $res['prix'] ?> €</b></p>

                    <?php
                    $dispo = $res['disponible'];
                    if($dispo == false){
                        $dispo =  "NON";
                    }else{
                        $dispo = "OUI";
                    }
                    ?>

                    <p><b>Disponible : </b><b><?= $dispo ?></b></p>
                    <?php
                    $date_a = new DateTime($res['date_arrivee']);
                    $date_d = new DateTime($res['date_depart']);
                    ?>
                    <p><b>Date d'arrivée : </b> </p>
                    <p><?=  $date_a->format('d-m-Y à H:i:s')?></p>

                    <p><b>Date de depart : </b></p>
                    <p> <?=  $date_d->format('d-m-Y à H:i:s')?></p>
                    <a href="reservation&id=<?= $res['id'] ?>" class="btn btn-outline-info">RESERVER</a>
            <a href="index" class="btn btn-outline-danger">RETOUR</a>
                </div>
            </div>
        </div>
        <?php
    }

// Formulaire de recherche avec les dates d'arrivées et de départ ainsi que le nombre de chambres
    public function RechercheGenerale(){

        if(isset($_POST['date_arrivee'])){
            $date_arrivee = $_POST['date_arrivee'];
        }
        if(isset($_POST['date_depart'])){

            $date_depart = $_POST['date_depart'];
        }

        if(isset($_POST['nbr_chambre'])){
            $nbr_chambre = $_POST['nbr_chambre'];
        }
        $datetoday=date('Y-m-d');
        $db= $this->connectPDO();
        $req=$db->prepare("SELECT * FROM `gites` WHERE `date_arrivee` >'".$datetoday."' AND nbr_chambre = '".$nbr_chambre."'");
        $req->execute();
        //var_dump($req);
        $products = $req->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <div class="container text-center mt-5">
        <div class="row ">
            <?php
            foreach ($products as $row):
                ?>
                <div class="col-lg-4 d-flex align-items-stretch">
                    <div class="card mt-3">
                        <img class="img-fluid" src="<?php echo $row['img_gite'] ?>"
                             alt="<?php echo $row['nom_gite'] ?>" title="<?php echo $row['nom_gite']; ?>">
                        <h5 class="font-weight-bold mt-3"><?php echo $row['nom_gite'] ?></h5>
                        <h5 class="font-weight-bold mt-3">Prix : <?php echo $row['prix'] ?> EUR</h5>
                        <a class="btn btn-primary p-3 m-2 font-weight-bold"
                           href="reservation&id=<?= $row['id'] ?>">Reserver</a>
                        <a class="btn btn-warning p-3 m-2 font-weight-bold"
                           href="detailsUserGite&id=<?= $row['id'] ?>" target="_blank">Plus d'infos</a>
                    </div>
                </div>
            <?php
            endforeach; ?>
        </div>
    </div>
<?php
    }

// Barre de recherche par mots-clés avec le champ nom_gite pour l'utilisateur avec les gîtes disponibles
    public function searchGite(){
        $db=$this->connectPDO();
        $search=$_POST['search'];
        $req=$db->prepare("SELECT * FROM `gites` WHERE nom_gite LIKE :nom_gite");
        $req->bindValue(':nom_gite',"%$search%");
        $req->execute();
        $products = $req->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($req);
        ?>
 <div class="container text-center mt-5">
        <div class="row ">
            <?php
            foreach ($products as $row):
                ?>
                <div class="col-lg-4 d-flex align-items-stretch">
                    <div class="card mt-3">
                        <img class="img-fluid" src="<?php echo $row['img_gite'] ?>"
                             alt="<?php echo $row['nom_gite'] ?>" title="<?php echo $row['nom_gite']; ?>">
                        <h5 class="font-weight-bold mt-3"><?php echo $row['nom_gite'] ?></h5>
                        <h5 class="font-weight-bold mt-3">Prix : <?php echo $row['prix'] ?> EUR</h5>
                        <a class="btn btn-primary p-3 m-2 font-weight-bold"
                           href="reservation&id=<?= $row['id'] ?>">Reserver</a>
                        <a class="btn btn-warning p-3 m-2 font-weight-bold"
                           href="detailsUserGite&id=<?= $row['id'] ?>">Plus d'infos</a>
                    </div>
                </div>
            <?php
            endforeach; ?>
        </div>
    </div>
    <?php

    }

// Barre de recherche par mots-clés avec le champ nom_gite  pour l'admin avec tous les gîtes
    public function searchGiteAdmin(){
    $db=$this->connectPDO();
    $search=$_POST['search'];
    $req=$db->prepare("SELECT * FROM `gites`INNER JOIN category_gites ON gites.gite_category = category_gites.id_category WHERE nom_gite= '$search'");
    $req->execute();
    $products = $req->fetchAll(PDO::FETCH_ASSOC);
    //var_dump($req);
    ?>
    <div class="container text-center mt-5">
        <div class="row ">
            <?php
            foreach ($products as $row):
                ?>
                <div class="col-lg-4 d-flex align-items-stretch">
                    <div class="card mt-3">
                        <img class="img-fluid" src="<?php echo $row['img_gite'] ?>"
                             alt="<?php echo $row['nom_gite'] ?>" title="<?php echo $row['nom_gite']; ?>">
                        <h5 class="font-weight-bold mt-3"><?php echo $row['nom_gite'] ?></h5>
                        <h5 class="font-weight-bold mt-3">Prix : <?php echo $row['prix'] ?> EUR</h5>
                        <h5 class="font-weight-bold mt-3">Type de logement : <?php echo $row['type'] ?></h5>
                        <a class="btn btn-primary p-3 m-2 font-weight-bold"
                           href="detailsGite&id=<?= $row['id'] ?>">Détails</a>
                        <a class="btn btn-warning p-3 m-2 font-weight-bold"
                           href="updateGite&id=<?= $row['id'] ?>">Mettre à jour</a>
                        <a class="btn btn-danger p-3 m-2 font-weight-bold"
                           href="deleteGite&id=<?= $row['id'] ?>">Supprimer</a>
                    </div>
                </div>
            <?php
            endforeach; ?>
        </div>
    </div>
    <?php

}

// Ajouter un gîte
    public function confirmajouterGite()
    {


        if(isset($_POST['nom_gite'])){
            $this->nom_gite = $_POST['nom_gite'];
        }

        if(isset($_POST['description_gite'])){
            $this->description_gite = $_POST['description_gite'];
        }

        if(isset($_POST['img_gite'])){
            $this->img_gite = $_POST['img_gite'];
        }

        if(isset($_POST['nbr_chambre'])){
            $this->nbr_chambre = $_POST['nbr_chambre'];
        }

        if(isset($_POST['nbr_sdb'])){
            $this->nbr_sdb= $_POST['nbr_sdb'];
        }

        if(isset($_POST['zone_geo'])){
            $this->zone_geo = $_POST['zone_geo'];
        }

        if(isset($_POST['prix'])){
            $this->prix = $_POST['prix'];
        }

        if(isset($_POST['disponible'])){
            $this->disponible = $_POST['disponible'];
        }

        if(isset($_POST['date_arrivee'])){
            $this->date_arrivee = $_POST['date_arrivee'];
        }

        if(isset($_POST['date_depart'])){
            $this->date_depart = $_POST['date_depart'];
        }

        if(isset($_POST['type_gite'])){
            $this->type_gite = $_POST['type_gite'];
        }

        /*var_dump($_POST['nom_gite']);
        var_dump($_POST['description_gite']);
        var_dump($_POST['img_gite']);
        var_dump($_POST['prix']);
        var_dump($_POST['nbr_chambre']);
        var_dump($_POST['nbr_sdb']);
        var_dump($_POST['disponible']);
        var_dump($_POST['zone_geo']);
        var_dump($_POST['date_arrivee']);
        var_dump($_POST['date_depart']);
        var_dump($_POST['type_gite']);*/

        $db = $this->connectPDO();
        $req = $db->prepare("INSERT INTO `gites`(`nom_gite`, `description_gite`, `img_gite`, `prix`, `nbr_chambre`, `nbr_sdb`, `disponible`, `zone_geo`, `date_arrivee`, `date_depart`, `gite_category`) 
                                        VALUES (?,?,?,?,?,?,?,?,?,?,?)");
        $req->bindParam(1, $this->nom_gite);
        $req->bindParam(2, $this->description_gite);
        $req->bindParam(3, $this->img_gite);
        $req->bindParam(4, $this->prix);
        $req->bindParam(5, $this->nbr_chambre);
        $req->bindParam(6, $this->nbr_sdb);
        $req->bindParam(7, $this->disponible);
        $req->bindParam(8, $this->zone_geo);
        $req->bindParam(9, $this->date_arrivee);
        $req->bindParam(10, $this->date_depart);
        $req->bindParam(11, $this->type_gite);
        $req->execute();
?> <a href="admin">Retour</a>
            <?php
    }

// Détails d'un gite en plus volumineux dans la page update
    public function getGiteById(){
        $db = $this->connectPDO();
        $req = $db->prepare("SELECT * FROM gites INNER JOIN category_gites ON gites.gite_category = category_gites.id_category INNER JOIN departement ON gites.zone_geo = departement.departement_id WHERE gites.id = ? ");
        $id = $_GET['id'];
        $req->bindParam(1, $id);
        $req->execute();
        $res = $req->fetch();
        ?>

        <div>
            <div class="row mt-5">
                <div class="col-6">
                    <img width="100%" src="<?= $res['img_gite'] ?>" alt="<?= $res['nom_gite'] ?>" title="<?= $res['nom_gite'] ?>"/>
                </div>
                <div class="col-6">
                    <p><b>Nom du gite: </b><?= $res['nom_gite'] ?></p>
                    <p><b>Type: </b> <?= $res['type'] ?></p>
                    <p class="card-text"><b>Description : </b></p>
                    <p><?= $res['description_gite'] ?></p>
                    <p><b>Nombre de chambre : </b><b><?= $res['nbr_chambre'] ?></b></p>
                    <p><b>Nombre de salle de bains : </b><b><?= $res['nbr_sdb'] ?></b></p>
                    <p><b>Zone géographique : </b><b><?= $res['departement_nom_uppercase'] ?></b></p>
                    <p><b>Prix à la semaine : </b><b><?= $res['prix'] ?> €</b></p>

                    <?php
                    $dispo = $res['disponible'];
                    if($dispo == false){
                        $dispo =  "NON";
                    }else{
                        $dispo = "OUI";
                    }
                    ?>

                    <p><b>Disponible : </b><b><?= $dispo ?></b></p>
                    <?php
                    $date_a = new DateTime($res['date_arrivee']);
                    $date_d = new DateTime($res['date_depart']);
                    ?>
                    <p><b>Date d'arrivée : </b> </p>
                    <p><?=  $date_a->format('d-m-Y à H:i:s')?></p>

                    <p><b>Date de depart : </b></p>
                    <p> <?=  $date_d->format('d-m-Y à H:i:s')?></p>
                    <!--<a href="reservation.php?id=<?= $res['id'] ?>" class="btn btn-outline-info">RESERVER</a>
            <a href="index.php" class="btn btn-outline-danger">RETOUR</a>-->
                </div>
            </div>
        </div>
        <?php
    }

// Update un gîte,page de récupération
    public function updateGite(){
        $db=$this->connectPDO();
        $req = $db->prepare("SELECT * FROM gites INNER JOIN category_gites ON gites.gite_category = category_gites.id_category INNER JOIN departement ON gites.zone_geo = departement.departement_id WHERE gites.id = ? ");
        $id = $_GET['id'];
        $req->bindParam(1, $id);
        $req->execute();
        $row = $req->fetch();
        ?>

        <?php
        if (isset($_FILES['img_gite'])) {
            $uploaddir = './assets/img/';
            $img_gite = $uploaddir . basename($_FILES['img_gite']['name']);
            $_POST['img_gite'] = $img_gite;
            if (move_uploaded_file($_FILES['img_gite']['tmp_name'], $img_gite)) {

                echo '<p class="alert-success text-center mt-5">Le fichier est valide et à été téléchargé avec succès ! <a href="admin">Retour</a> </p> ';
            } else {
                echo '<p class="alert-danger text-center mt-5">Une erreur s\'est produite, le fichier n\'est pas valide !</p>';
            }
        } else {
            echo "<p class='alert-warning p-2 text-center mt-5'>Merci de respecter le format d'image valide : png, svg, jpg, jpeg, webp !</p>";
        }

        if(isset($_POST['test'])){
            $gite = new GitesModels();
            $gite->ConfirmupdateGite();
        }
        ?>


        <div class="container mt-5 col-lg-6">
            <h1 class="text-info text-center">Mettre à jour un gite</h1>
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nom_gite">Nom du gite : </label>
                    <input type="text" class="form-control" id="nom_gite" name="nom_gite" value="<?=$row['nom_gite'] ?>">
                </div>

                <div class="form-group">
                    <label for="description_gite">Description du gite : </label>
                    <textarea class="form-control"  id="description_gite" name="description_gite" rows="3"><?= $row['description_gite'] ?></textarea>
                </div>

                <div class="form-group">
                    <label for="img_gite">Image du gite : </label>
                    <br/>
                    <input type="file" value="<?= $row['img_gite'] ?>" name="img_gite">
                </div>


                <div class="form-group">
                    <label for="nbr_chambre">Nombre de chambre : </label>
                    <select class="form-control" id="nbr_chambre" name="nbr_chambre">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="nbr_sdb">Nombre de salle de bains : </label>
                    <select class="form-control"  id="nbr_sdb" name="nbr_sdb">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="zone_geo">Zone Geographique</label>
                    <select name="zone_geo"  class="form-control" id="zone_geo">
                    <?php $req=$db->query("SELECT * FROM departement");
                    foreach ($req as $result){
                    ?><option value="<?= $result['departement_code']?>"><?= $result['departement_nom_uppercase']?></option>
                     <?php
                      }
                      ?>
                    </select>

                <div class="form-group">
                    <label for="prix">Prix / semaine : </label>
                    <input type="number" value="<?= $row['prix'] ?>" step="0.01" class="form-control" id="prix" name="prix" placeholder="">
                </div>

                <div class="form-group">
                    <label for="disponible">Disponible : </label>
                    <select class="form-control" name="disponible" id="disponible">
                        <option value="0">NON</option>
                        <option value="1">OUI</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="date_arrivee">Date d'arrivée : </label>
                    <input type="date" value="<?= $row['date_arrivee'] ?>" id="date_arrivee" name="date_arrivee" >
                </div>

                <div class="form-group">
                    <label for="date_depart">Date de départ : </label>
                    <input type="date" value="<?= $row['date_depart'] ?>" id="date_depart" name="date_depart" >
                </div>

                <div class="form-group">
                    <label for="type_gite">Type de gite</label>
                    <select name="type_gite"  class="form-control" id="type_gite">
                      <?php $req=$db->query("SELECT * FROM category_gites");
                    foreach ($req as $result){
                    ?><option value="<?= $result['id_category']?>"><?= $result['type']?></option>
                     <?php
                      }
                      ?>
                    </select>
                </div>
                <button type="submit" name="test" class="btn btn-success text-end ">Mettre à jour le gite</button>
            </form>
        </div>
<?php
    }

// Confirmer update d'un gîte, page de traitement
    public function ConfirmupdateGite(){

        $db = $this->connectPDO();

        if(isset($_POST['nom_gite'])){
            $update_nom_gite = $_POST['nom_gite'];
        }

        if(isset($_POST['description_gite'])){
            $update_description_gite = $_POST['description_gite'];
        }

        if(isset($_POST['img_gite'])){
            $update_img_gite = $_POST['img_gite'];
        }

        if(isset($_POST['nbr_chambre'])){
            $update_nbr_chambre = $_POST['nbr_chambre'];
        }

        if(isset($_POST['nbr_sdb'])){
            $update_nbr_sdb= $_POST['nbr_sdb'];
        }

        if(isset($_POST['zone_geo'])){
            $update_zone_geo = $_POST['zone_geo'];
        }

        if(isset($_POST['prix'])){
            $update_prix = $_POST['prix'];
        }

        if(isset($_POST['disponible'])){
            $update_disponible = $_POST['disponible'];
        }

        if(isset($_POST['date_arrivee'])){
            $update_date_arrivee = $_POST['date_arrivee'];
        }

        if(isset($_POST['date_depart'])){
            $update_date_depart = $_POST['date_depart'];
        }

        if(isset($_POST['type_gite'])){
            $type_gite = $_POST['type_gite'];
        }

        $sql = "UPDATE gites SET nom_gite = ?, description_gite = ?, img_gite = ?, nbr_chambre = ?, nbr_sdb = ?, zone_geo = ?, prix = ?, disponible = ?, date_arrivee = ?, date_depart = ?, gite_category = ? WHERE id = ?";
        $id = $_GET['id'];
        $req = $db->prepare("SELECT * FROM gites WHERE id = ?");
        $req->fetch(PDO::FETCH_ASSOC);
        $update = $update= $db->prepare($sql);
        $update->bindParam(1, $update_nom_gite);
        $update->bindParam(2, $update_description_gite);
        $update->bindParam(3, $update_img_gite);
        $update->bindParam(4, $update_nbr_chambre);
        $update->bindParam(5, $update_nbr_sdb);
        $update->bindParam(6, $update_zone_geo);
        $update->bindParam(7, $update_prix);
        $update->bindParam(8, $update_disponible);
        $update->bindParam(9, $update_date_arrivee);
        $update->bindParam(10, $update_date_depart);
        $update->bindParam(11, $type_gite);
        $maj = $update->execute(array($update_nom_gite, $update_description_gite, $update_img_gite, $update_nbr_chambre, $update_nbr_sdb, $update_zone_geo, $update_prix, $update_disponible, $update_date_arrivee, $update_date_depart, $type_gite, $id));
        /*if($maj){
            header("Location:http://localhost/poo-gites/admin.php");
        }else{
            echo "<p class='alert-danger p-2'>Merci de verifié et remplir tous les champs !</p>";
        }*/

        /* var_dump($update);
        var_dump($update_nom_gite);
        var_dump($update_description_gite);
        var_dump($update_img_gite);
        var_dump($update_nbr_chambre);
        var_dump($update_nbr_sdb);
        var_dump($update_zone_geo);
        var_dump($update_prix);
        var_dump($update_disponible);
        var_dump($update_date_arrivee);
        var_dump($update_date_depart);
        var_dump($type_gite);*/


        $req = $db->prepare("SELECT * FROM gites INNER JOIN category_gites ON gites.gite_category = category_gites.id_category WHERE gites.id = ? ");
        $id = $_GET['id'];
        $req->bindParam(1, $id);
        $req->execute();

    }

// Affichage d' un gite avant suppresion, page de récupération
    public function supprimerGite(){
        $db=$this->connectPDO();
        $req = $db->prepare("SELECT * FROM gites INNER JOIN category_gites  ON gites.gite_category = category_gites.id_category INNER JOIN departement ON gites.zone_geo = departement.departement_id WHERE gites.id = ? ");
        $id = $_GET['id'];
        $req->bindParam(1, $id);
        $req->execute();
        $row = $req->fetch();
        ?>
        <div class="container text-center mt-5">
            <div>
                <div class="col-lg-4 d-flex align-items-stretch">
                    <div class="card mt-3">
                        <img class="img-fluid" src="<?=$row['img_gite'] ?>" alt="Card image cap" >
                        <div class="card-body ">
                            <h5 class="card-title "><?= $row['nom_gite'] ?></h5>
                            <p class="card-text"><b>Description:</b> <?= $row['description_gite'] ?></p>
                            <p class="card-text"><b>Zone géographique:</b> <?= $row['zone_geo'] ?></p>
                            <p class="card-text"><b>Type:</b> <?= $row['type'] ?></p>
                            <p class="card-text">Il y a <?= $row['nbr_chambre'] ?> chambres.</p>
                            <p class="card-text">Il y a <?= $row['nbr_sdb'] ?> salle(s) de bains</p>
                            <?php
                            $dispo = $row['disponible'];
                            if($dispo == false){
                                $dispo =  "NON";
                            }else{
                                $dispo = "OUI";
                            }
                            ?>
                            <p class="card-text"><b>Disponible:</b> <?= $dispo ?> </p>
                            <?php
                            $date_a = new DateTime($row['date_arrivee']);
                            $date_d = new DateTime($row['date_depart']);
                            ?>
                            <p class="card-text"><b>Date d'arrivée:</b> <?= $date_a->format('d-m-Y à H:i:s')?></p>
                            <p class="card-text"><b>Date de départ:</b> <?= $date_d->format('d-m-Y à H:i:s') ?></p>
                            <p class="card-text">La location a la semaine du logement est de  <?= $row['prix'] ?> € </p>
                            <a href="updateGite&id=<?=$row ['id']?>" class="btn btn-warning">Mettre à jour</a>
                            <a href="ConfirmdeleteGite&id=<?=$row ['id']?>" class="btn btn-danger">Supprimer</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php

    }

// Confirmer la suppresion d' un gite, page de traitement
    public function ConfirmdeleteGite(){
        $db=$this->connectPDO();
        $req = $db->prepare("DELETE  FROM gites WHERE id = ? ");
        if (isset($_GET['id']) && !empty($_GET['id'])){
            $id=strip_tags($_GET['id']);
            $req->bindParam(1, $id);
            $req->execute();
        }?>
        <a href="admin">Retour</a>
        <?php
    }

// Méthode de login
    public function adminLogin()
    {
    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $pass = $_POST['password'];

        $login = new GitesModels();
        $db = $login->connectPDO();

        $sql = "SELECT * FROM admin WHERE email_admin = '$email'";
        $result = $db->prepare($sql);
        $result->execute();


        if ($result->rowCount() > 0) {
            $data = $result->fetchAll();
            if (password_verify($pass, $data[0]['password_admin'])) {
                echo '<div class="container text-center font-weight-bold alert alert-success mt-5">Connexion effectué</div>';
                $_SESSION['email'] = $email;
                $_SESSION['connecter'] = true;
                header('Location: admin');
            } else {
                echo '<div class="container text-center font-weight-bold alert alert-danger mt-5">Erreur email et mot passe pas bon</div>';
            }
        } else {
            $pass = password_hash($pass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO admin (email_admin, password_admin) VALUES ('$email', '$pass')";
            $req = $db->prepare($sql);
            $req->execute();
            echo '<div class="container text-center font-weight-bold alert alert-success mt-5">Enregistrement effectué</div>';

        }
    }

    ?>

    <div class="container mt-5 col-lg-4">
        <form method="POST" action="">
            <div class="form-group">
                <label for="exampleInputPassword1">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Email">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Mot de passe</label>
                <input type="password" name="password" class="form-control" placeholder="Mot de passe">
            </div>
            <button type="submit" value="connexion" name="submit" class="btn btn-primary">Connexion</button>
        </form>
        <?php
        }

    /*public function LectureDepartement(){
    $db=$this->connectPDO();
    $req=$db->query("SELECT * FROM departement");
    foreach ($req as $row){
        ?><option value="<?= $row['departement_code']?>"><?= $row['departement_nom_uppercase']?></option>
        <?php
    }

}
*/
}
