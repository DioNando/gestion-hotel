<!-- MODIFICATION -->

<div class="modal fade" id="modalReservationUpdate" tabindex="-1" aria-labelledby="#" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="#">Modification</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalUpdateDay">
                
            
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

                    <!-- <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-danger" id="btnDelete" name="btn_suppression">Effacer</button>
                    </div>

                    <div class="d-grid gap-2 mt-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    </div> -->

                    <hr class="my-3">
                    <div class="container">
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

<!-- INFO -->

<div class="modal fade" id="modalReservationInfo" tabindex="-1" aria-labelledby="#" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
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

<!-- INFO RESERVATION -->

<div class="modal fade" id="modalReservationInfoDay" tabindex="-1" aria-labelledby="#" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="#">Informations réservation</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalInfoDay">

            </div>

        </div>
    </div>
</div>

<!-- JAVASCRIPT -->

<script type="text/javascript">
    // function updateData(ID_day) {
    //     document.getElementById('inputID_day').value = ID_day;
    //     document.getElementById('btnDelete').value = "Modifier";
    // }

    function deleteData(ID_day) {
        document.getElementById('innerIDdel').innerHTML = ID_day;
        document.getElementById('inputIDdel').value = ID_day;
        document.getElementById('btnDelete').value = "Effacer";
    }

    function infoSupplementaireDay(ID_day, info) {
        $(document).ready(function() {

            if (info == 'infoDay') {
                $.ajax({
                    url: 'ReservationDay',
                    type: 'post',
                    data: {
                        ID_day: ID_day,
                        infoDay: info
                    },

                    success: function(data) {
                        $('#modalInfoDay').html(data);
                    }
                })
            }

            if (info == 'infoDetails') {
                $.ajax({
                    url: 'ReservationDay',
                    type: 'post',
                    data: {
                        ID_day: ID_day,
                        infoDetails: info
                    },

                    success: function(data) {
                        $('#modalInfoDetails').html(data);
                    }
                })
            }

            if (info == 'updateDay') {
                $.ajax({
                    url: 'ReservationDay',
                    type: 'post',
                    data: {
                        ID_day: ID_day,
                        updateDay: info
                    },

                    success: function(data) {
                        $('#modalUpdateDay').html(data);
                    }
                })
            }

        });
    }
</script>