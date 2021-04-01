<!-- MODIFICATION -->

<div class="modal fade" id="modalReservationUpdate" tabindex="-1" aria-labelledby="#" aria-hidden="true">
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
                                <label for="ID_day" class="form-label">Identification</label>
                                <input type="text" class="form-control" id="inputID_chambre" name="ID_day" readonly>
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <div class="form-group">
                                <label for="tarif_chambre" class="form-label">Tarif nuit</label>
                                <input type="number" class="form-control" id="inputTarif_chambre" name="tarif_chambre">
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

<div class="modal fade" id="modalReservationDelete" tabindex="-1" aria-labelledby="#" aria-hidden="true">
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
                        <label for="ID_day" class="form-label">Identification</label>
                        <input type="text" class="form-control" id="inputIDdel" name="ID_day" readonly>
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

<!-- INFO -->

<div class="modal fade" id="modalReservationInfo" tabindex="-1" aria-labelledby="#" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="#">Détails</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <table class="table table-hover table-striped table-light mb-0">
                    <thead>
                        <tr>
                            <th scope="col">Durée</th>
                            <th scope="col">N°Chambre</th>
                            <th scope="col">Prix Unitaire</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">2</th>
                            <td>1</td>
                            <td>20.000</td>
                            <td>40.000</td>
                        </tr>
                        <tr>
                            <td colspan="3">TOTAL</td>
                            <td><b>40.000</b></td>
                        </tr>
                        <tr>
                            <td colspan="2">Payement du 20/06/2020</td>
                            <td colspan="1">Espèce</td>
                            <td>40.000</td>
                        </tr>
                        <tr>
                            <td colspan="3">RESTE A PAYER</td>
                            <td><b>0</b></td>
                        </tr>
                    </tbody>
                </table>


            </div>

        </div>
    </div>
</div>

<!-- JAVASCRIPT -->

<script type="text/javascript">
    function updateData(ID_day, tarif_chambre, staut_chambre) {
        document.getElementById('inputID_chambre').value = ID_day;
        document.getElementById('inputTarif_chambre').value = tarif_chambre;
        document.getElementById('btnDelete').value = "Modifier";
    }

    function deleteData(ID_day) {
        document.getElementById('innerIDdel').innerHTML = ID_day;
        document.getElementById('inputIDdel').value = ID_day;
        document.getElementById('btnDelete').value = "Effacer";
    }
</script>