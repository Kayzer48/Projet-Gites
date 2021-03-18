<?php
include_once 'partials/header.php';
$login = new GitesModels();
$login->adminLogin();
?>

<?php
include_once 'partials/footer.php';