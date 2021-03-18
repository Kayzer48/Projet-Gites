<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "vendor/autoload.php";

class EmailReservation
{
    public function giteReservation()
    {

        //Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);


        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host = 'smtp.mailtrap.io';                     //Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   //Enable SMTP authentication
            $mail->Username = '3424cf2c5a408e';                     //SMTP username
            $mail->Password = '2187232eeee7ae';                               //SMTP password
            //$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port = 2525;

            $mail->CharSet = 'UTF-8';


            //Recipients
            $mail->setFrom('gites@gite.com', 'Annonces');
            $mail->addAddress('gites@gite.com', 'Administrateur gites.com');     //Add a recipient
            $mail->addReplyTo('gites@gite.com', 'Information');

            $getGites = new GitesModels();
            $db = $getGites->connectPDO();
            $query = "SELECT * FROM gites INNER JOIN category_gites ON gites.gite_category = category_gites.id_category WHERE gites.id = ?";
            $req = $db->prepare($query);
            $id = $_GET['id'];
            $req->bindParam(1, $id);
            $req->execute();
            $rows = $req->fetchAll();


            //$my_path = "/xampp/htdocs/OOP/assets/img/gites-de-france.jpg";

            //Attachments
            //$mail->addAttachment($my_path);         //Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //$mail->AddEmbeddedImage(dirname(__FILE__) . 'assets/img/gites-de-france.jpg', 'gite ');

            //Contenu du mail
            $mail->isHTML(true);
            $destinataire = $_POST['email_user'];
            $mail->Subject = "Validation de votre resevation du gite sur locagite@gite.com";
            //Boucle de lecture pour retrouver le token ID
            foreach ($rows as $row) {
                $Id = $row['id'];
                $url = "http://localhost/OOP/confirmation_reseravation.php";


                $mail->Body = '<!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html">
        <title>Votre reservation chez locagite.com</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body style="color: #6cc3d5;">
    <div style="color: #6cc3d5; padding: 20px;">
        <img src="https://qiwo-indie-games.alwaysdata.net/assets/images/2.jpg" style="display: block; border-radius: 100%" width="50px" height="50px">
        <h3 style="color: #1D2326">LOCA-GITES.COM</h3>
        
        <!--INFOS DE DEBUG -->
        <p>ICI URL DU GITE A RESERVER : ' . $url . '</p>
        <p>ICI ID DU GITE A RESERVER: ' . $Id . '  </p>
        
    </div>
    <div style="padding: 20px;">
        <h1>Loca-gite.com</h1>
        <h2>Vous : ' . $destinataire . '</h2>
        <p>Vous avez déposé une demande de reservation (ET C BIEN)  avec le liens suivant</p><br />
        <p>Recapitulatif de votre commande</p>
        <p>Nom du gite :<b style="color: #2c4f56">' . $row['nom_gite'] . '</b></p>
        <p>Description du gite :<b style="color: #2c4f56"> ' . $row['description_gite'] . '</b></p>
        <p>Image du gite :<img src="https://www.leboupere.fr/medias/2016/02/Logo-gite.png"/></p>
        <p>Prix par semaine du gite :<b style="color: #2c4f56"> ' . $row['prix'] . ' €</b></p>
        <p>Nombre de chambre :<b style="color: #2c4f56"> ' . $row['nbr_chambre'] . '</b></p>
        <p>Nombre de salle de bain :<b style="color: #2c4f56"> ' . $row['nbr_sdb'] . '</b></p>
        <p>Zone géographique :<b style="color: #2c4f56"> ' . $row['zone_geo'] . '</b></p>
        <p>Date arrivée :<b style="color: #2c4f56"> ' . $row['date_arrivee'] . '</b></p>
        <p>Date départ :<b style="color: #2c4f56"> ' . $row['date_depart'] . '</b></p>
        <p>Description du gite :<b style="color: #2c4f56"> ' . $row['type'] . '</b></p>
        <p>Toutes fois vous avez la possibilité d\'annuler ou de confirmer votre commande</p>
        <br /><br />
        <a href="' . $url . '" style="background-color: darkred; color: #F0F1F2; padding: 20px; text-decoration: none;">Confimer la reservation de votre gite</a><br />
        <br />
        <p>Merci d\'utiliser notre site web</p>
        <p>Cordialement : Loca-gite.com: Michael MICHEL : Administrateur</p>    
    </div>
    </body>
    </html>
    ';
                $mail->body = "MIME-Version: 1.0" . "\r\n";
                $mail->body .= "Content-type:text/html;charset=utf8" . "\r\n";

            }

            $mail->send();


            //header("http://localhost/oop/confirmation_reservation.php?id=$emailId");
        } catch (Exception $e) {
            echo "<p class='alert-danger p-3'>Erreur lors de la tentative d'envoi de l'email {$mail->ErrorInfo}</p>";
        }

    }

}