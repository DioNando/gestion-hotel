<div class="modal fade" id="modalChambreUpdate" tabindex="-1" aria-labelledby="#" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modification</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalUpdateChambre">
                
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modalChambreUpdateReservation" tabindex="-1" aria-labelledby="#" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ajout d'un lit supplémentaire</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalUpdateChambreReservation">
                
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
                <form action="deleteChambre" method="post">
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
                        <!-- <hr class="my-3"> -->
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

<!-- SAUVEGARDER NOUVEAU TARIF -->

<div class="modal fade" id="modalTarifSave" tabindex="-1" aria-labelledby="#" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="#">Sauvegarder</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Enregistrer les nouveaux tarifs ?</p>
                <!-- <form action="#" method="post"> -->

                    <div class="container">
                        <!-- <hr class="my-3"> -->
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
                            <button class="col-4 mx-2 center btn btn-primary" type="button" onclick="chambreJSON()" name="btn_saveTarif">
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
                    </div>
                <!-- </form> -->
            </div>

        </div>
    </div>
</div>

<!-- JAVASCRIPT -->

<script type="text/javascript">
    // function updateData(ID_chambre, description_chambre, tarif_chambre, statut_chambre) {
    //     document.getElementById('inputID_chambre').value = ID_chambre;
    //     document.getElementById('inputDescri_chambre').value = description_chambre;
    //     document.getElementById('inputTarif_chambre').value = tarif_chambre;
    //     document.getElementById('inputStatut_chambre').value = statut_chambre;
    //     document.getElementById('btnDelete').value = "Modifier";
    // }

    function deleteData(ID_chambre) {
        document.getElementById('innerIDdel').innerHTML = ID_chambre;
        document.getElementById('inputIDdel').value = ID_chambre;
        document.getElementById('btnDelete').value = "Effacer";
    }

    function updateChambre(ID_chambre, type) {
        $(document).ready(function() {

            if (type == 'update') {
                $.ajax({
                    url: 'updateChambre',
                    type: 'post',
                    data: {
                        ID_chambre: ID_chambre,
                        type: type,
                    },

                    success: function(data) {
                        $('#modalUpdateChambre').html(data);
                    }
                })
            }
        });
    }

    function updateStatut(ID_chambre, type) {
        $(document).ready(function() {

            if (type == 'update') {
                $.ajax({
                    url: 'updateStatut',
                    type: 'post',
                    data: {
                        ID_chambre: ID_chambre,
                        type: type,
                    },

                    success: function(data) {
                        $('#modalUpdateChambre').html(data);
                    }
                })
            }
        });
    }

    function updateChambreReservation(ID_chambre, ID_planning, type) {
        $(document).ready(function() {

            if (type == 'update') {
                $.ajax({
                    url: 'updateChambreReservation',
                    type: 'post',
                    data: {
                        ID_chambre: ID_chambre,
                        ID_planning: ID_planning,
                        type: type,
                    },

                    success: function(data) {
                        $('#modalUpdateChambreReservation').html(data);
                    }
                })
            }
        });
    }
</script>