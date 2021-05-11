<?php
$total = 0;
foreach ($details as $detail) {
    $total = $total + ($detail['tarif_chambre'] * $detail['nbr_nuit'] + $detail['lit_sup'] * $detail['tarif_lit_sup']);
}
$montant = $total - $total * $detail['remise'] / 100;
$reste = $montant - $detail['somme_donne_nuit'];
?>

<div class="row">
    <div class="container bg light"></div>
    <div class="col">
        <!-- <h5 class="mt-3 mb-3">A propos de la réservation</h5> -->
        <div class="mb-1 row">
            <label class="col-auto col-form-label">Création :</label>
            <div class="col">
                <input type="text" readonly class="form-control-plaintext" value="<?php echo ($info['date_reservation_nuit'] . ' par ' . $info['nom_user']); ?>" readonly>
            </div>
        </div>
    </div>
    <div class="col">
        <!-- <h5 class="mt-3 mb-3">A propos du client</h5> -->
        <div class="mb-1 row">
            <label class="col-auto col-form-label">Modification :</label>
            <div class="col">
                <input type="text" readonly class="form-control-plaintext" value="<?php echo ($info['date_modification_nuit'] . ' par ' . $info['nom_user_modif']); ?>" readonly>
            </div>
        </div>
    </div>


    <div class="col-12">
        <div class="mb-1 row">
            <label class="col-auto col-form-label">Commentaire :</label>
            <div class="col">
                <input type="text" class="form-control-plaintext" value="<?php echo ($info['commentaire_nuit']); ?>" readonly>
            </div>
        </div>
    </div>

    <div class="col">
        <!-- <h5 class="mt-3 mb-3">A propos de la réservation</h5> -->
        <div class="mb-1 row">
            <label class="col-auto col-form-label">Début :</label>
            <div class="col-auto">
                <input type="text" readonly class="form-control-plaintext" value="<?php echo ($info['debut_sejour']); ?>" readonly>
            </div>
        </div>

    </div>
    <div class="col">
        <!-- <h5 class="mt-3 mb-3">A propos du client</h5> -->
        <div class="mb-1 row">
            <label class="col-auto col-form-label">Fin :</label>
            <div class="col-auto">
                <input type="text" readonly class="form-control-plaintext" value="<?php echo ($info['fin_sejour']); ?>" readonly>
            </div>
        </div>
    </div>

    <div class="container">
        <hr class="my-2">
    </div>

    <div class="col">
        <div class="mb-1 row">
            <label class="col-auto col-form-label">Nom :</label>
            <div class="col-auto">
                <input type="text" readonly class="form-control-plaintext" value="<?php echo ($info['nom_client']); ?>" readonly>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="mb-1 row">
            <label class="col-auto col-form-label">Prénom :</label>
            <div class="col-auto">
                <input type="text" readonly class="form-control-plaintext" value="<?php echo ($info['prenom_client']); ?>" readonly>
            </div>
        </div>
    </div>



    <div class="mb-1 row">
        <label class="col-auto col-form-label">Remarque :</label>
        <div class="col">
            <input type="text" readonly class="form-control-plaintext" value="<?php echo ($info['remarque_reservation']); ?>" readonly>
        </div>
    </div>


</div>

<hr>

<table class="table table-hover table-striped mb-0">
    <thead>
        <tr>
            <th scope="col" class="text-end">Nuitée</th>
            <th scope="col" class="text-end">Date</th>
            <th scope="col">N°Chambre</th>
            <th scope="col" class="text-end">Prix Unitaire</th>
            <th scope="col">Lit supplémentaire</th>
            <th scope="col" class="text-end">Total</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($details as $detail) { ?>
            <tr>
                <td class="text-end"> <?php echo ($detail['nbr_nuit'] . ' nuitées') ?> </td>
                <td class="text-end"> <?php echo ($detail['debut_sejour']) ?> </td>
                <td class="text-center"> <?php echo ($detail['ID_chambre']) ?> </td>
                <td class="text-end"> <?php echo number_format($detail['tarif_chambre'], '0', '', ' ') . ' Ar' ?> </td>
                <td class="text-center"> <?php echo number_format($detail['lit_sup'] * $detail['tarif_lit_sup'], '0', '', ' ') . ' Ar' ?> </td>
                <td class="text-end"> <?php echo number_format($detail['tarif_chambre'] * $detail['nbr_nuit'] + $detail['lit_sup'] * $detail['tarif_lit_sup'], '0', '', ' ') . ' Ar' ?> </td>
            </tr>
        <?php } ?>


        <tr>
            <td colspan="5">TOTAL (avec <?php echo ($detail['remise'] . '% de remise)'); ?> </td>
            <td class="text-end"><b> <?php echo number_format($montant, '0', '', ' ') . ' Ar'; ?> </b></td>
        </tr>
        <tr>
            <td colspan="3">Payement du <?php echo ($detail['date_facture_nuit']); ?></td>
            <td colspan="2"><?php echo ($detail['type_payement_nuit']); ?></td>
            <td class="text-end"> <?php echo number_format($detail['somme_donne_nuit'], '0', '', ' ') . ' Ar'; ?> </td>
        </tr>
        <tr>
            <td colspan="5">RESTE A PAYER</td>
            <td class="text-end"><b> <?php echo number_format($reste, '0', '', ' ') . ' Ar'; ?> </b></td>
        </tr>
    </tbody>
</table>