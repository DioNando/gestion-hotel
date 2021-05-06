<?php
$page = $_SERVER['REQUEST_URI'];
?>

<!-- <nav class="navbar navbar-light bg-light mb-3">
    <div class="container-fluid"> -->
<nav class="navbar navbar-light mb-2">
    <div class="container-fluid px-0">

        <?php if (session()->get('isUser') == 'Administrateur') : ?>
            <?php if ($page == '/hotel/public/configTarif') { ?>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalNouveauChambre" name="btn_nouveau">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-plus-circle"></i>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            Nouveau
                        </div>
                    </div>
                </button>
            <?php } ?>
            <?php if ($page == '/hotel/public/configUser') { ?>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalNouveauUser" name="btn_nouveau">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-plus-circle"></i>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            Nouveau
                        </div>
                    </div>
                </button>
            <?php } ?>
        <?php endif ?>

        <a class="navbar-brand"></a>
        <form class="d-flex" method="post">
            <!-- <div class="input-group"> -->
                <input class="form-control me-2" type="search" name="element_recherche" id="search" aria-label="Search" autocomplete="off">
                <button class="btn btn-outline-success border" type="submit" name="btn_recherche">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-search"></i>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            Rechercher
                        </div>
                    </div>
                </button>
            <!-- </div> -->
        </form>
    </div>
</nav>