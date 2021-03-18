<?php
$title = 'Search';
$search= new GitesModels();
?>
<nav class="navbar navbar-light bg-light">
    <form class="form-inline" method="post" action="searchGite">
        <input class="form-control mr-sm-2" type="search" placeholder="ex: Gite Grenoble" aria-label="Search" name="search">
        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Rechercher</button>
    </form>
</nav>
<?php $search ->searchGite();?>
