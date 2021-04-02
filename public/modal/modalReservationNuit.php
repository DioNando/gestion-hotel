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
                                <label for="ID_nuit" class="form-label">Identification</label>
                                <input type="text" class="form-control" id="inputID_nuit" name="ID_nuit" readonly>
                            </div>
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
                        <label for="ID_nuit" class="form-label">Identification</label>
                        <input type="text" class="form-control" id="inputIDdel" name="ID_nuit" readonly>
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
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="#">Détails</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalInfoDetails">




            </div>

        </div>
    </div>
</div>

<!-- INFO CLIENT -->

<div class="modal fade" id="modalReservationInfoClient" tabindex="-1" aria-labelledby="#" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="#">Informations client</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalInfoClient">

            </div>

        </div>
    </div>
</div>

<!-- INFO RESERVATION -->

<div class="modal fade" id="modalReservationInfoNuit" tabindex="-1" aria-labelledby="#" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="#">Informations réservation</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalInfoNuit">

            </div>

        </div>
    </div>
</div>

<!-- JAVASCRIPT -->

<script type="text/javascript">
    function updateData(ID_nuit) {
        document.getElementById('inputID_nuit').value = ID_nuit;
        document.getElementById('btnDelete').value = "Modifier";
    }

    function deleteData(ID_nuit) {
        document.getElementById('innerIDdel').innerHTML = ID_nuit;
        document.getElementById('inputIDdel').value = ID_nuit;
        document.getElementById('btnDelete').value = "Effacer";
    }

    function infoSupplementaireNuit(ID_nuit, info) {
        $(document).ready(function() {

            if (info == 'infoClient') {

                $.ajax({
                    url: 'ReservationNuit',
                    type: 'post',
                    data: {
                        ID_nuit: ID_nuit,
                        infoClient: info
                    },

                    success: function(data) {
                        $('#modalInfoClient').html(data);
                    }
                })
            }

            if (info == 'infoNuit') {
                $.ajax({
                    url: 'ReservationNuit',
                    type: 'post',
                    data: {
                        ID_nuit: ID_nuit,
                        infoNuit: info
                    },

                    success: function(data) {
                        $('#modalInfoNuit').html(data);
                    }
                })
            }

            if (info == 'infoDetails') {
                $.ajax({
                    url: 'ReservationNuit',
                    type: 'post',
                    data: {
                        ID_nuit: ID_nuit,
                        infoDetails: info
                    },

                    success: function(data) {
                        $('#modalInfoDetails').html(data);
                    }
                })
            }

        });
    }
</script>