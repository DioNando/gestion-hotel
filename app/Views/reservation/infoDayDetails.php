<div class="container">
    <!-- <div class="container-fluid bg-light formulaire"> -->
    <!-- <h1 class="center mt-3 mb-3">
        <div class="row container-fluid">
                <div class="col text-start">Facturation day use</div>
                <div class="col-1 center"><i class="fas fa-calendar-day"></i></div>
            </div>
        </h1> -->
    <form action="facture" method="post">
        <div class="row">
            <div class="col-12">
                <!-- <?php if (session()->get('success')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->get('success') ?>
                        </div>
                    <?php endif; ?> -->
            </div>

            <div class="container">
                <div class="row">
                    <div class="col">
                        <h5 class="mt-3 mb-3">De</h5>

                        <div class="mb-1 row">
                            <label for="#" class="col-sm-2 col-form-label">Facture n ° </label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="#" value="<?php echo ($facture['ID_facture_day']) ?>" name="ID_facture_day" readonly>
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <label for="#" class="col-sm-2 col-form-label">Nom</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="#" value="Hotel" readonly>
                            </div>
                        </div>

                        <div class="mb-1 row">
                            <label for="#" class="col-sm-2 col-form-label">Adresse</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="#" value="rue 02 Toamasina" readonly>
                            </div>
                        </div>

                        <div class="mb-1 row">
                            <label for="#" class="col-sm-2 col-form-label">Mail</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="#" value="hotel@mail.mg" readonly>
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <label for="#" class="col-sm-2 col-form-label">Téléphone</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="#" value="+261 34 00 000 01" readonly>
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <label for="#" class="col-sm-2 col-form-label">Par</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="#" value="<?php echo ($info['nom_user']) ?>" name="nom_user" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <h5 class="mt-3 mb-3">Adresse de facturation</h5>

                        <div class="mb-1 row">
                            <label for="#" class="col-sm-2 col-form-label">Nom</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="#" value="<?php echo ($info['nom_client_day']) ?>" readonly>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <div class="col-12 col-sm-6 mt-2 mb-2 text-center">
                <div class="form-group">
                    <label for="date_facture_day" class="form-label">Date de facturation</label>
                    <!-- <input type="date" class="form-control" id="dateFacturation" name="debut_sejour"> -->
                    <input type="date" class="form-control" value="<?php echo($facture['date_facture_day']) ?>" name="date_facture_day">
                </div>
            </div>
            <div class="col-12 col-sm-6 mt-2 mb-2 text-center">
                <div class="form-group">
                    <label class="form-label" for="">Type de payement</label>
                    <select class="form-select" name="type_payement">
                        <option <?php if ($facture['type_payement_day'] == 'Espece') echo ('selected'); ?> value="Espece">Espèce</option>
                        <option <?php if ($facture['type_payement_day'] == 'MVola') echo ('selected'); ?> value="MVola">MVola</option>
                        <option <?php if ($facture['type_payement_day'] == 'Orange Money') echo ('selected'); ?> value="Orange Money">Orange Money</option>
                        <option <?php if ($facture['type_payement_day'] == 'Airtel Money') echo ('selected'); ?> value="Airtel Money">Airtel Money</option>
                        <option <?php if ($facture['type_payement_day'] == 'VISA') echo ('selected'); ?> value="VISA">VISA</option>   
                        <option <?php if ($facture['type_payement_day'] == 'Autre') echo ('selected'); ?> value="Autre">Autre</option>   
                    </select>
                </div>
            </div>

            <?php
            $total = 0;
            foreach ($details as $detail) {
                $total = $total + ($detail['tarif_chambre'] * $detail['duree_day']);
            }
            $montant = $total;
            $reste = $total - $montant;
            ?>

            <table class="table mt-2">
                <thead>
                    <tr>
                        <th scope="col">N°Chambre</th>
                        <th scope="col" class="text-end">Durée</th>
                        <th scope="col" class="text-end">Prix Unitaire</th>
                        <th scope="col" class="text-end">Montant</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($details as $detail) { ?>
                        <tr>
                            <th> <?php echo ($detail['ID_chambre']); ?> </th>
                            <td scope="row" class="text-end"> <?php echo ($detail['duree_day'] . 'h'); ?> </td>
                            <td class="text-end"> <?php echo number_format($detail['tarif_chambre'], '0', '', ' ')  . ' Ar' ?> </td>
                            <td class="text-end"> <?php echo number_format($detail['tarif_chambre'] * $detail['duree_day'], '0', '', ' ') . ' Ar' ?> </td>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <hr class="mt-4">

            <table>

                <tr>
                    <td class="text-end">Total</td>
                    <td class="text-center"><b> <?php echo number_format($total, '0', '', ' ') . ' Ar' ?> </b></td>
                </tr>
                <!-- <tr>
                        <td class="text-end">Solde Dû</td>
                        <td class="text-center"><b> <?php echo number_format($reste, '0', '', ' ') . ' Ar' ?> </b></td>
                    </tr> -->
            </table>
            <!-- <div class="col-12 col-sm-6">
                    <div class="d-grid gap-2 mt-3">
                        <button type="submit" class="btn btn-primary" name="btn_facture_day">Sauvegarder</button>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="d-grid gap-2 mt-3">
                        <button type="submit" class="btn btn-secondary" name="btn_imprimer" onclick="genPDF()" disabled>Imprimer</button>
                    </div>
                </div> -->


            <div class="container-fluid d-flex justify-content-end mt-3">
                <button type="submit" class="btn btn-primary mx-2" name="btn_facture_day">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-save"></i>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            Sauvegarder
                        </div>
                    </div>
                </button>
                <button type="submit" class="btn btn-secondary mx-2" name="btn_imprimer" onclick="genPDF()" disabled>
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-print"></i>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            Imprimer
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
        </div>
    </form>
    <!-- </div> -->
</div>

<script>
    var dateDebut = new Date();
    document.getElementById('dateFacturation').valueAsDate = dateDebut;

    function genPDF() {

        // html2canvas($('#facturePDF'), {
        //     onrendered: function(canvas) {
        //         var img = canvas.toDataURL()
        //         var doc = new jsPDF;
        //         doc.addImage(img, 'PNG', 20, 20);
        //         doc.save('Facture.pdf');
        //     }
        // });

        var doc = new jsPDF;
        doc.fromHTML($('#facturePDF').get(0), 20, 20);
        doc.save('Facture.pdf');
    }
</script>