<!-- NOUVEAU CLIENT -->

<div class="modal fade" id="modalNouveauClient" tabindex="-1" aria-labelledby="#" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="#">Nouveau Client</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="#">

                <!-- <div class="container-fluid col-12"> -->
                <!-- <div class="container-fluid bg-light formulaire"> -->
                <!-- <h1 class="center">NOUVEAU CLIENT</h1> -->
                <form action="" method="post">
                    <?php if (session()->get('success')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->get('success') ?>
                        </div>
                    <?php endif; ?>
                    <div class="form-group col-12"><label class="form-label" for="">Nom</label>
                        <input type="text" class="form-control" name="nom_client" id="">
                    </div>

                    <div class="form-group mt-2 col-12">
                        <label class="form-label" for="">Prénom</label>
                        <input type="text" class="form-control" name="prenom_client" id="">
                    </div>
                    <div class="form-group mt-2">
                        <label class="form-label" for="">Téléphone</label>
                        <input type="tel" class="form-control" name="telephone_client" id="">
                    </div>
                    <hr>
                    <div class="container-fluid p-0 d-flex justify-content-end">
                        <button class="btn btn-outline-primary me-0" onclick="chambreJSON()" name="btn_validation">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-save"></i>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    Sauvegarder
                                </div>
                            </div>
                        </button>
                    </div>
                    <?php
                    if (isset($validation)) : ?>
                        <div class="col-12 mt-3">
                            <div class="alert alert-danger" role="alert">
                                <?= $validation->listErrors() ?>
                            </div>
                        </div>
                    <?php endif ?>
                </form>
                <!-- </div> -->
                <!-- </div> -->

            </div>

        </div>
    </div>
</div>

<!-- ANCIEN CLIENT -->

<div class="modal fade" id="modalAncienClient" tabindex="-1" aria-labelledby="#" aria-hidden="true">
    <div class="modal-dialog center">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ancien Client</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- <div class="container-fluid col-12"> -->
                <!-- <div class="container-fluid bg-light formulaire"> -->
                <!-- <h1 class="center">ANCIEN CLIENT</h1> -->
                <form action="" method="post">
                    <?php if (session()->get('success')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->get('success') ?>
                        </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col pe-2">
                            <input class="col form-control me-0" type="search" name="element_recherche" id="search" placeholder="Nom du client" aria-label="Search" autocomplete="off">
                        </div>
                        <div class="col-auto ps-2">
                            <button class="col-auto btn btn-outline-primary ms-0" type="submit" name="btn_recherche">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-search"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        Rechercher
                                    </div>
                                </div>
                            </button>
                        </div>
                    </div>

                    <?php
                    if (isset($validation_recherche)) : ?>
                        <div class="col-12 mt-3">
                            <div class="alert alert-danger" role="alert">
                                <?= $validation_recherche->listErrors() ?>
                            </div>
                        </div>
                    <?php endif ?>
                </form>
                <!-- </div> -->
                <!-- </div> -->

            </div>

        </div>
    </div>
</div>