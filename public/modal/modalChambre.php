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
                                <label for="tarif_nuit" class="form-label">Tarif nuit</label>
                                <input type="number" class="form-control" id="inputTarif_nuit" name="tarif_nuit">
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <div class="form-group">
                                <label for="tarif_heure" class="form-label">Tarif heure</label>
                                <input type="number" class="form-control" id="inputTarif_heure" name="tarif_heure">
                            </div>
                        </div>
                        <div class="form-group mt-2">
                            <label for="">Statut chambre</label>
                            <select class="form-select" name="statut_chambre">
                                <option selected value="Libre">Libre</option>
                                <option value="Occupée">Occupée</option>
                                <option value="En attente">En attente</option>
                            </select>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary" id="btnSubmit" name="btn_modification">Modifier</button>
                        </div>
                        <div class="d-grid gap-2 mt-3">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
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

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-danger" id="btnDelete" name="btn_suppression">Effacer</button>
                    </div>

                    <div class="d-grid gap-2 mt-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- JAVASCRIPT -->

<script type="text/javascript">
    function updateData(ID_chambre, tarif_nuit, tarif_heure, staut_chambre) {
        document.getElementById('inputID_chambre').value = ID_chambre;
        document.getElementById('inputTarif_nuit').value = tarif_nuit;
        document.getElementById('inputTarif_heure').value = tarif_heure;
        document.getElementById('btnDelete').value = "Modifier";
    }

    function deleteData(ID_chambre) {
        document.getElementById('innerIDdel').innerHTML = ID_chambre;
        document.getElementById('inputIDdel').value = ID_chambre;
        document.getElementById('btnDelete').value = "Effacer";
    }
</script>