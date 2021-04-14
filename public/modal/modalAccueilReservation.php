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
                            <div class="d-grid gap-2 mt-3">
                                <button type="submit" class="btn btn-outline-primary" name="btn_validation">Valider</button>
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
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="#">Ancien Client</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="#">
                <!-- <div class="container-fluid col-12"> -->
                    <!-- <div class="container-fluid bg-light formulaire"> -->
                        <!-- <h1 class="center">ANCIEN CLIENT</h1> -->
                        <form action="" method="post">
                            <?php if (session()->get('success')) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session()->get('success') ?>
                                </div>
                            <?php endif; ?>
                            <div class="form-group">
                                <input class="form-control me-2" type="search" name="element_recherche" id="search" placeholder="Nom du client" aria-label="Search" autocomplete="off">
                            </div>
                            <hr>
                            <div class="d-grid gap-2 mt-3">
                                <button class="btn btn-outline-primary" type="submit" name="btn_recherche">Rechercher</button>
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