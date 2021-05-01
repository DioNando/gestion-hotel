<!-- NOUVEAU USER -->

<div class="modal fade" id="modalNouveauUser" tabindex="-1" aria-labelledby="#" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="#">Nouvel utilisateur</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalNouveauUser">

                <form action="" method="post">
                    <div class="form-group">
                        <label class="form-label" for="nom_user">Nom</label>
                        <input type="text" class="form-control" name="nom_user" id="">
                    </div>
                    <div class="form-group mt-2">
                        <label class="form-label" for="prenom_user">Prénom</label>
                        <input type="text" class="form-control" name="prenom_user" id="">
                    </div>

                    <div class="form-group mt-2">
                        <label class="form-label" for="mdp_user">Mot de passe</label>
                        <input type="password" class="form-control" name="mdp_user" id="">
                    </div>
                    <div class="form-group mt-2">
                        <label class="form-label" for="">Droit d'accès</label>
                        <select class="form-select" name="droit_user">
                            <option selected value="Utilisateur">Utilisateur</option>
                            <option value="Controleur">Contrôleur</option>
                            <option value="Administrateur">Administrateur</option>
                        </select>
                    </div>
                    <hr>
                    <!-- <div class="d-grid gap-2 mt-3">
                        <button type="submit" class="btn btn-primary" name="btn_enregistrer">Valider</button>
                    </div> -->
                    <div class="container-fluid p-0 d-flex justify-content-end">
                        <button class="btn btn-primary me-0" onclick="chambreJSON()" name="btn_enregistrer">
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
                </form>
            </div>

        </div>
    </div>
</div>

<!-- NOUVEAU CLIENT -->

<!-- <div class="modal fade" id="modalNouveauClient" tabindex="-1" aria-labelledby="#" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="#">Nouveau client</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalNouveauClient">
                <form action="" method="post">
                    <div class="form-group"><label class="form-label" for="">Nom</label>
                        <input type="text" class="form-control" name="nom_client" id="">
                    </div>
                    <div class="form-group mt-2">
                        <label class="form-label" for="">Prénom</label>
                        <input type="text" class="form-control" name="prenom_client" id="">
                    </div>
                    <div class="form-group mt-2">
                        <label class="form-label" for="">Téléphone</label>
                        <input type="tel" class="form-control" name="telephone_client" id="">
                    </div>
                    <hr>
                    <div class="d-grid gap-2 mt-3">
                        <button type="submit" class="btn btn-primary" name="btn_validation">Valider</button>
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
            </div>

        </div>
    </div>
</div> -->

<!-- NOUVELLE CHAMBRE -->

<div class="modal fade" id="modalNouveauChambre" tabindex="-1" aria-labelledby="#" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="#">Nouvelle chambre</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalNouveauChambre">
                <form action="" method="post">
                    <div class="form-group">
                        <label class="form-label" for="description_chambre">Description</label>
                        <input type="text" class="form-control" name="description_chambre" id="description_chambre">
                    </div>
                    <div class="form-group mt-2">
                        <label class="form-label" for="tarif_chambre">Tarif par nuit</label>
                        <input type="number" class="form-control" name="tarif_chambre" id="tarif_chambre" min="1" placeholder="ariary">
                    </div>


                    <div class="form-group mt-2">
                        <label class="form-label" for="">Statut chambre</label>
                        <select class="form-select" name="statut_chambre">
                            <option selected value="Libre">Libre</option>
                            <option value="Occupée">Occupée</option>
                            <option value="En attente">En attente</option>
                        </select>
                    </div>
                    <hr>
                    <div class="container-fluid p-0 d-flex justify-content-end">
                        <button class="btn btn-primary me-0" onclick="chambreJSON()" name="btn_enregistrer">
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
            </div>

        </div>
    </div>
</div>

<!-- JAVASCRIPT -->

<!-- <script type="text/javascript">

    function nouveauUser() {
        $(document).ready(function() {
            $.ajax({
                    url: 'nouveauUser',
                    type: 'post',
                    data: {
                        type: 'user',
                    },

                    success: function(data) {
                        $('#modalNouveauUser').html(data);
                    }
                })
        });
    }

    function nouveauClient() {
        // $(document).ready(function() {
            $.ajax({
                    url: 'nouveauClient',
                    type: 'post',
                    data: {
                        type: 'client',
                    },

                    success: function(data) {
                        $('#modalNouveauClient').html(data);
                    }
                })
        // });
    }

    function nouveauChambre() {
        // $(document).ready(function() {
            $.ajax({
                    url: 'nouveauChambre',
                    type: 'post',
                    data: {
                        type: 'chambre',
                    },

                    success: function(data) {
                        $('#modalNouveauChambre').html(data);
                    }
                })
        // });
    }

</script> -->