<?php
$total = 0;
foreach ($details as $detail) {
    $total = $total + ($detail['tarif_chambre'] * $detail['duree_day']);
}
$montant = $total;
$rendu = $facture['somme_donne_day'] - $total;
if ($rendu < 0) {
    $rendu = 0;
};
$reste = $total - $facture['somme_donne_day'];
if ($reste < 0) {
    $reste = 0;
};
?>

<div class="container p-0">
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

                <div class="mb-1 row">
                    <div class="col-auto">
                        <input type="text" readonly class="form-control-plaintext" id="#" value="Hotel" readonly>
                    </div>
                </div>

                <div class="mb-1 row">
                    <div class="col-auto">
                        <input type="text" readonly class="form-control-plaintext" id="#" value="rue 02 Toamasina" readonly>
                    </div>
                </div>

                <div class="mb-1 row">
                    <label for="#" class="col-auto col-form-label">Mail :</label>
                    <div class="col-auto">
                        <input type="text" readonly class="form-control-plaintext" id="#" value="hotel@mail.mg" readonly>
                    </div>
                </div>
                <div class="mb-1 row">
                    <label for="#" class="col-auto col-form-label">Téléphone :</label>
                    <div class="col-auto">
                        <input type="text" readonly class="form-control-plaintext" id="#" value="+261 34 00 000 01" readonly>
                    </div>
                </div>
                <hr class="my-3">
                <div class="mb-1 row">
                    <label for="#" class="col-auto col-form-label">Facture n ° </label>
                    <div class="col-auto">
                        <input type="text" readonly class="form-control-plaintext" id="#" value="<?php echo ($facture['ID_facture_day']) ?>" name="ID_facture_day" readonly>
                    </div>
                </div>
                <div class="mb-1 row">
                    <label for="#" class="col-auto col-form-label">Par :</label>
                    <div class="col-auto">
                        <input type="text" readonly class="form-control-plaintext" id="#" value="<?php echo (session()->get('nom_user')) ?>" name="nom_user" readonly>
                    </div>
                </div>
                <div class="mb-1 row">
                    <label for="#" class="col-auto col-form-label">Nom :</label>
                    <div class="col-auto">
                        <input type="text" readonly class="form-control-plaintext" id="#" value="<?php echo ($info['nom_client_day']) ?>" readonly>
                    </div>
                </div>


                <div class="row">
                    <div class="col-12 col-sm-3 mt-2 mb-2 text-center">
                        <div class="form-group">
                            <label for="date_facture_nuit" class="form-label">Total Ariary</label>
                            <div class="input-group">
                                <input type="number" class="form-control" value="<?php echo ($total) ?>" name="date_facture_day" readonly>
                                <span class="input-group-text">Ar</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-3 mt-2 mb-2 text-center">
                        <div class="form-group">
                            <label for="date_facture_nuit" class="form-label">Reste précedent</label>
                            <div class="input-group">
                                <input type="number" class="form-control" value="<?php echo ($reste) ?>" name="date_facture_day" readonly>
                                <span class="input-group-text">Ar</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 mt-2 mb-2 text-center">
                        <div class="form-group">
                            <label for="somme_facture_nuit" class="form-label">Somme donnée</label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="somme_donne_day" value="0" onclick="calculFacture(this.value, <?php echo ($reste) ?>)" onmousedown="calculFacture(this.value, <?php echo ($reste) ?>)" onkeyup="calculFacture(this.value, <?php echo ($reste) ?>)" min="0">
                                <span class="input-group-text">Ar</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 mt-2 mb-2 text-center">
                        <div class="form-group">
                            <label for="rendu_nuit" class="form-label">Rendu</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="rendu_day" name="rendu_facture_day" readonly>
                                <span class="input-group-text">Ar</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 mt-2 mb-2 text-center">
                        <div class="form-group">
                            <label for="reste_nuit" class="form-label">Reste</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="reste_day" name="reste_facture_day" readonly>
                                <span class="input-group-text">Ar</span>
                            </div>
                        </div>
                    </div>
                </div>


            </div>




            <div class="col-12 col-sm-6 mt-2 mb-2 text-center">
                <div class="form-group">
                    <label for="date_facture_day" class="form-label">Date de facturation</label>
                    <!-- <input type="date" class="form-control" id="dateFacturation" name="debut_sejour"> -->
                    <input type="date" class="form-control" value="<?php echo ($facture['date_facture_day']) ?>" name="date_facture_day">
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
                        <option <?php if ($facture['type_payement_day'] == 'Cheque') echo ('selected'); ?> value="Cheque">Chèque</option>
                        <option <?php if ($facture['type_payement_day'] == 'VISA') echo ('selected'); ?> value="VISA">VISA</option>
                        <option <?php if ($facture['type_payement_day'] == 'Autre') echo ('selected'); ?> value="Autre">Autre</option>
                    </select>
                </div>
            </div>


            <div class="container">
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
            </div>


            <table>

                <tr>
                    <td class="text-end">Sous-total</td>
                    <td class="text-center"><?php echo number_format($total, '0', '', ' ') . ' Ar' ?></td>
                </tr>
                <tr>
                    <td class="text-end">Somme donnée</td>
                    <td class="text-center"><?php echo number_format($facture['somme_donne_day'], '0', '', ' ') . ' Ar' ?></td>
                </tr>
                <tr>
                    <td class="text-end">Rendu</td>
                    <td class="text-center"><?php echo number_format($rendu, '0', '', ' ') . ' Ar' ?></td>
                </tr>
                <tr>
                    <td class="text-end">Reste</td>
                    <td class="text-center"><?php echo number_format($reste, '0', '', ' ') . ' Ar' ?></td>
                </tr>

                <tr>
                    <td class="text-end">Total</td>
                    <td class="text-center"><b> <?php echo number_format($total, '0', '', ' ') . ' Ar' ?> </b></td>
                </tr>


            </table>
          
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
                <button type="button" class="btn btn-secondary mx-2" id="imprimer">
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

<div style="position:absolute; visibility: hidden; top: 0; z-index: -5">
    <div class="container" id="facturePDF">
        <h2>Hotel</h2>
        <div>Rue 2 Toamasina</div>
        <div>Mail : hotel@mail.mg</div>
        <div>Téléphone : +261 34 00 000 01</div>

        <h3>Facture n ° <?php echo ($facture['ID_facture_day']) ?></h3>
        <div>Du : <?php echo ($facture['date_facture_day']) ?></div>
        <div>Fait par : <?php echo (session()->get('nom_user')) ?></div>
        <div>Au nom de : <?php echo ($info['nom_client_day']) ?></div>
        <h4>Client au comptant Ariary</h4>
        <div>Type de payement : <?php echo ($facture['type_payement_day']) ?></div>

        <table>
            <thead>
                <tr>
                    <th>N°Chambre</th>
                    <th>Durée</th>
                    <th>Prix Unitaire</th>
                    <th>Montant</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($details as $detail) { ?>
                    <tr>
                        <th> <?php echo ($detail['ID_chambre']) ?> </th>
                        <td> <?php echo ($detail['duree_day']) ?> </td>
                        <td> <?php echo number_format($detail['tarif_chambre'], '0', '', ' ')  . ' Ar' ?> </td>
                        <td> <?php echo number_format($detail['tarif_chambre'] * $detail['duree_day'], '0', '', ' ') . ' Ar' ?> </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>


        <table>
            <tr>
                <td>Somme donnée</td>
                <td><?php echo ($facture['somme_donne_day'] . ' Ar') ?></td>
            </tr>
            <tr>
                <td>Rendu</td>
                <td><?php echo ($rendu . ' Ar') ?></td>
            </tr>
            <tr>
                <td>Reste</td>
                <td><?php echo ($reste . ' Ar') ?></td>
            </tr>
            <tr>
                <td>Total</td>
                <td><?php echo ($total . ' Ar') ?></td>
            </tr>
        </table>
    </div>
</div>

<script>
    // function genPDF() {
    //     html2canvas($("#facturePDF"), {
    //         onrendered: function(canvas) {
    //             var imgData = canvas.toDataURL(
    //                 'image/png');
    //             var doc = new jsPDF('p', 'mm');
    //             doc.addImage(imgData, 'PNG', 10, 10);
    //             doc.save('sample-Facture.pdf');
    //         }
    //     });

        // var doc = new jsPDF;
        // doc.fromHTML($('#facturePDF').get(0), 20, 20);
        // doc.save('Facture.pdf');
    // }

    $('#imprimer').click(function() {
        var pdf = new jsPDF('p', 'pt', 'letter'),
            source = $('#facturePDF')[0],
            specialElementHandlers = {
                '#bypassme': function(element, renderer) {
                    return true
                }
            }

        margins = {
            top: 40,
            bottom: 60,
            left: 40,
            right: 40,
            width: '100%'
        };
        pdf.fromHTML(
            source, margins.left, margins.top, {
                'width': margins.width,
                'elementHandlers': specialElementHandlers,
            },
            function(dispose) {
                pdf.save("<?php echo ('Facture ' . $info['nom_client_day'] . ' ' . date('d-m-y H-i')) ?>");
            },
            margins
        )
    });


    function calculFacture(somme, total) {
        let rendu, reste;

        if (somme >= total) {
            rendu = somme - total;
            reste = 0;
        } else {
            rendu = 0;
            reste = total - somme;
        }

        document.getElementById('rendu_day').value = rendu;
        document.getElementById('reste_day').value = reste;
    }
</script>