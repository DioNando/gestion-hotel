<?php
$page = $_SERVER['REQUEST_URI'];
?>

<!-- <nav class="navbar navbar-light bg-light mb-3">
    <div class="container-fluid"> -->
<nav class="navbar navbar-light mb-2">
    <div class="container-fluid" style="padding-left: 0; padding-right:0">

        <?php if (session()->get('isUser') == 'Administrateur') : ?>
            <?php if ($page == '/hotel/public/configChambre') { ?>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalNouveauChambre" name="btn_nouveau">Nouveau</button>
            <?php } ?>
            <?php if ($page == '/hotel/public/configUser') { ?>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalNouveauUser" name="btn_nouveau">Nouveau</button>
            <?php } ?>
        <?php endif ?>

        <a class="navbar-brand"></a>
        <form class="d-flex" method="post">
            <input class="form-control me-2" type="search" name="element_recherche" id="search" placeholder=".   .   ." aria-label="Search" autocomplete="off">
            <button class="btn btn-outline-success" type="submit" name="btn_recherche">Rechercher</button>
        </form>
    </div>
</nav>