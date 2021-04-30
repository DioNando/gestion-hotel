<?php include("assets/toast/myToast.php"); ?>

<div class="container">
    <div class="container-fluid bg-light formulaire">
        <h1 class="center mt-3 mb-3">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1 me-3">
                    Facturation day use
                </div>
                <div class="flex-shrink-0">
                    <i class="fas fa-sun"></i>
                </div>
            </div>
        </h1>
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
                                    <input type="text" readonly class="form-control-plaintext" id="#" value="<?= session()->get('nom_user') ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <h5 class="mt-3 mb-3">Adresse de facturation</h5>

                            <div class="mb-1 row">
                                <label for="#" class="col-sm-2 col-form-label">Nom</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="#" value="<?= session()->get('nom_client_day') ?>" readonly>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="col-12 col-sm-6 mt-2 mb-2 text-center">
                    <div class="form-group">
                        <label for="debut_sejour" class="form-label">Date de facturation</label>
                        <input type="date" class="form-control" id="dateFacturation" name="debut_sejour">
                    </div>
                </div>
                <div class="col-12 col-sm-6 mt-2 mb-2 text-center">
                    <div class="form-group">
                        <label class="form-label" for="">Type de payement</label>
                        <select class="form-select" name="type_payement">
                            <option selected value="Espece">Espèce</option>
                            <option value="MVola">MVola</option>
                            <option value="Orange Money">Orange Money</option>
                            <option value="Airtel Money">Airtel Money</option>
                            <option value="VISA">VISA</option>
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
                <div class="col-12 col-sm-6">
                    <div class="d-grid gap-2 mt-3">
                        <button type="submit" class="btn btn-primary" name="btn_facture_day">Sauvegarder</button>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="d-grid gap-2 mt-3">
                        <button type="submit" class="btn btn-secondary" name="btn_imprimer" onclick="genPDF()" disabled>Imprimer</button>
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