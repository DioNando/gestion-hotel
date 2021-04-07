<!-- UPDATE -->

<div class="modal fade" id="modalClientUpdate" tabindex="-1" aria-labelledby="#" aria-hidden="true">
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
                                <label for="ID_client" class="form-label">Identification</label>
                                <input type="text" class="form-control" id="inputID_client" name="ID_client" readonly>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 mt-2">
                            <div class="form-group">
                                <label for="nom_client" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="inputNom_client" name="nom_client">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 mt-2">
                            <div class="form-group">
                                <label for="prenom_client" class="form-label">Prénom</label>
                                <input type="text" class="form-control" id="inputPrenom_client" name="prenom_client">
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 mt-2">
                            <div class="form-group">
                                <label for="telephone_client" class="form-label">Téléphone</label>
                                <input type="tel" class="form-control" id="inputTelephone_client" name="telephone_client">
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
    function updateData(ID_client, nom_client, prenom_client, telephone_client) {
        document.getElementById('inputID_client').value = ID_client;
        document.getElementById('inputNom_client').value = nom_client;
        document.getElementById('inputPrenom_client').value = prenom_client;
        document.getElementById('inputTelephone_client').value = telephone_client;
        document.getElementById('btnDelete').value = "Modifier";
    }

    function deleteData(ID_client) {
        document.getElementById('innerIDdel').innerHTML = ID_client;
        document.getElementById('inputIDdel').value = ID_client;
        document.getElementById('btnDelete').value = "Effacer";
    }

    function infoFicheCardex(ID_client, cardex) {
        $(document).ready(function() {

            if (cardex == 'cardex') {
                $.ajax({
                    url: 'Cardex',
                    type: 'post',
                    data: {
                        ID_client: ID_client,
                        // infoDay: info
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