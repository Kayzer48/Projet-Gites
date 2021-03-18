<?php
$title = 'Reservation';
require 'models/EmailReservation.php';
$reservation = new EmailReservation();
?>
    <div class="container col-lg-4 mt-5">
        <form method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" name="email_user" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                       placeholder="Enter email ">
            </div>
            <button type="submit" name="validateReservation" class="btn btn-primary">Valider votre reservation</button>
        </form>
    </div>
<?php
if (isset($_POST['validateReservation'])) {
    $reservation->giteReservation();
}
