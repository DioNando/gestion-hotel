<!-- UPDATE -->

<div class="modal fade" id="modalClientUpdate" tabindex="-1" aria-labelledby="#" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="#">Modification</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalUpdateClient">

            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modalCardexUpdate" tabindex="-1" aria-labelledby="#" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="#">Modification</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalUpdateCardex">

            </div>

        </div>
    </div>
</div>

<!-- DELETE -->

<div class="modal fade" id="modalClientDelete" tabindex="-1" aria-labelledby="#" aria-hidden="true">
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
                        <label for="ID_client" class="form-label">Identification</label>
                        <input type="text" class="form-control" id="inputIDdel" name="ID_client" readonly>
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

<!-- CARDEX -->

<div class="modal fade" id="modalFicheCardex" tabindex="-1" aria-labelledby="#" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="#">Fiche cardex</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalCardex">


            </div>

        </div>
    </div>
</div>


<div id="historiqueNav" class="sideNav">
    <div id="modalHistorique">


    </div>
</div>

<script>
    function openNav(ID_client, type) {
        infoHistorique(ID_client, type);
        // document.getElementById("historiqueNav").style.width = "500px";
        $('#historiqueNav').hide('50');
        $('#historiqueNav').show('50');
    }

    function closeNav() {
        // document.getElementById("historiqueNav").style.width = "0";
        $('#historiqueNav').hide('100');
    }
</script>




<div class="modal fade" id="modalInfoHistorique" tabindex="-1" aria-labelledby="#" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="#">Historique de réservation</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- <div class="modal-body" id="modalHistorique">



            </div> -->

        </div>
    </div>
</div>

<!-- JAVASCRIPT -->

<script type="text/javascript">
    function deleteData(ID_client) {
        document.getElementById('innerIDdel').innerHTML = ID_client;
        document.getElementById('inputIDdel').value = ID_client;
        document.getElementById('btnDelete').value = "Effacer";
    }

    function updateClient(ID_client, type) {
        $(document).ready(function() {

            if (type == 'update') {
                $.ajax({
                    url: 'Client',
                    type: 'post',
                    data: {
                        ID_client: ID_client,
                        type: type,
                    },

                    success: function(data) {
                        $('#modalUpdateClient').html(data);
                    }
                })
            }
        });
    }

    function updateCardex(ID_client, type) {
        $(document).ready(function() {

            if (type == 'update') {
                $.ajax({
                    url: 'Cardex',
                    type: 'post',
                    data: {
                        ID_client: ID_client,
                        type: type,
                    },

                    success: function(data) {
                        $('#modalUpdateCardex').html(data);
                    }
                })
            }
        });
    }

    function infoFicheCardex(ID_client, cardex) {
        $(document).ready(function() {

            if (cardex == 'cardex') {
                $.ajax({
                    url: 'Cardex',
                    type: 'post',
                    data: {
                        ID_client: ID_client,
                    },

                    success: function(data) {
                        $('#modalCardex').html(data);
                    }
                })
            }

        });
    }

    var hide;

    function infoHistorique(ID_client, type) {
        $(document).ready(function() {

            // if (type == 'historique') {
            $.ajax({
                url: 'Cardex',
                type: 'post',
                data: {
                    ID_client: ID_client,
                    type: type,
                },

                success: function(data) {
                    $('#modalHistorique').html(data);
                }
            })
            // }

        });
    }

    function genPDF(ID_client, nom_client) {

        // html2canvas($('#ficheCardex'), {
        //     onrendered: function(canvas) {
        //         var img = canvas.toDataURL()
        //         var doc = new jsPDF;
        //         doc.addImage(img, 'PNG', 20, 20);
        //         doc.save('Cardex ' + nom_client + '.pdf');
        //     }
        // });

        var doc = new jsPDF;
        doc.fromHTML($('#ficheCardex').get(0), 20, 20);
        doc.save('Cardex ' + nom_client + '.pdf');
    }
</script>