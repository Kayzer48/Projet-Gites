<?php
require 'views/models/GitesModels.php';
$gite= new GitesModels();
?>

<div class="form-group">
<label for="zone_geo">Zone Geographique</label>
<select name="zone_geo"  class="form-control" id="zone_geo">
<?php $gite->LectureDepartement();?>
</select>
