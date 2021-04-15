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
    <div class="modal-dialog modal-lg modal-dialog-centered">
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

<!-- CARDEX -->

<div class="modal fade" id="modalFicheCardex" tabindex="-1" aria-labelledby="#" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h4 class="modal-title" id="#">Fiche cardex</h4> -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalCardex">




            </div>

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