<div class="modal fade" id="modalChambreUpdate" tabindex="-1" aria-labelledby="#" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="#">Modification</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="post">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="ID_chambre" class="form-label">Identification</label>
                                <input type="text" class="form-control" id="inputID_chambre" name="ID_chambre" readonly>
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <div class="form-group">
                                <label for="descri_chambre" class="form-label">Description de la chambre</label>
                                <input type="text" class="form-control" id="inputDescri_chambre" name="description_chambre">
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <div class="form-group">
                                <label for="inputTarif_chambre" class="form-label">Tarif</label>
                                <input type="number" class="form-control" id="inputTarif_chambre" name="tarif_chambre">
                            </div>
                        </div>
                        <div class="form-group mt-2">
                            <label class="form-label" for="">Statut chambre</label>
                            <select class="form-select" id="inputStatut_chambre" name="statut_chambre">
                                <option value="Libre">Libre</option>
                                <option value="Occupée">Occupée</option>
                                <option value="En attente">En attente</option>
                            </select>
                        </div>

                        <!-- <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary" id="btnSubmit" name="btn_modification">Modifier</button>
                        </div>
                        <div class="d-grid gap-2 mt-3">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        </div> -->

                        <hr class="my-3">
                        <div class="container">
                            <div class="row center mx-2">
                                <button class="col-4 mx-3 center btn btn-secondary" type="button" data-bs-dismiss="modal">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-times"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-2">
                                            Annuler
                                        </div>
                                    </div>
                                </button>
                                <button class="col-4 mx-3 center btn btn-primary" type="submit" id="btnSubmit" name="btn_modification">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-check"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-2">
                                            Modifier
                                        </div>
                                    </div>
                                </button>
                            </div>
                        </div>

                        <?php
                        if (isset($validation)) : ?>
                            <div class="col-12 mt-3">
                                <div class="alert alert-danger" role="alert">
                                    <?= $validation->listErrors() ?>
                                </div>
                            </div>
                        <?php endif ?>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- DELETE -->

<div class="modal fade" id="modalChambreDelete" tabindex="-1" aria-labelledby="#" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="#">Suppression</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Voulez-vous vraiment effacer la ligne <b id="innerIDdel"></b> ?</p>
                <form action="#" method="post">
                    <div class="mb-2" style="display: none;">
                        <label for="ID_chambre" class="form-label">Identification</label>
                        <input type="text" class="form-control" id="inputIDdel" name="ID_chambre" readonly>
                    </div>

                    <!-- <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-danger" id="btnDelete" name="btn_suppression">Effacer</button>
                    </div>

                    <div class="d-grid gap-2 mt-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    </div> -->

                    <div class="container">
                        <hr class="my-3">
                        <div class="row center mx-2">
                            <button class="col-4 mx-2 center btn btn-secondary" type="button" data-bs-dismiss="modal">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-times"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        Annuler
                                    </div>
                                </div>
                            </button>
                            <button class="col-4 mx-2 center btn btn-danger" type="submit" id="btnDelete" name="btn_suppression">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-trash-alt"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        Effacer
                                    </div>
                                </div>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- JAVASCRIPT -->

<script type="text/javascript">
    function updateData(ID_chambre, description_chambre, tarif_chambre, statut_chambre) {
        document.getElementById('inputID_chambre').value = ID_chambre;
        document.getElementById('inputDescri_chambre').value = description_chambre;
        document.getElementById('inputTarif_chambre').value = tarif_chambre;
        document.getElementById('inputStatut_chambre').value = statut_chambre;
        document.getElementById('btnDelete').value = "Modifier";
    }

    function deleteData(ID_chambre) {
        document.getElementById('innerIDdel').innerHTML = ID_chambre;
        document.getElementById('inputIDdel').value = ID_chambre;
        document.getElementById('btnDelete').value = "Effacer";
    }
</script>