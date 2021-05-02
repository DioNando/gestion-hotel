<?php
$total = 0;
foreach ($details as $detail) {
    $total = $total + ($detail['tarif_chambre'] * $detail['nbr_nuit'] + $detail['lit_sup'] * $detail['tarif_lit_sup']);
}
$montant = $total - $detail['remise'] * $total / 100;
$reste = $total - $total;
?>

<div class="row">
    <div class="col">
        <h5 class="mt-3 mb-3">A propos de la réservation</h5>

        <div class="mb-1 row">
            <label class="col-sm-2 col-form-label">Type de réservation</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" value="<?php echo ($info['type_reservation']); ?>" readonly>
            </div>
        </div>

        <div class="mb-1 row">
            <label class="col-sm-2 col-form-label">Remarque</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" value="<?php echo ($info['remarque_reservation']); ?>" readonly>
            </div>
        </div>

        <div class="mb-1 row">
            <label class="col-sm-2 col-form-label">Nombre de personne</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" value="<?php echo ($info['nbr_personne']); ?>" readonly>
            </div>
        </div>

        <div class="mb-1 row">
            <label class="col-sm-2 col-form-label">Date de réservation</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" value="<?php echo ($info['date_reservation_nuit'] . ' par ' . $info['nom_user']); ?>" readonly>
            </div>
        </div>

        <div class="mb-1 row">
            <label class="col-sm-2 col-form-label">Dernière modification</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" value="<?php echo ($info['date_modification_nuit'] . ' par ' . $info['nom_user_modif']); ?>" readonly>
            </div>
        </div>
    </div>
    <div class="col">
        <h5 class="mt-3 mb-3">A propos du client</h5>

        <div class="mb-1 row">
            <label class="col-sm-2 col-form-label">Nom</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" value="<?php echo ($info['nom_client']); ?>" readonly>
            </div>
        </div>

        <div class="mb-1 row">
            <label class="col-sm-2 col-form-label">Prénom</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" value="<?php echo ($info['prenom_client']); ?>" readonly>
            </div>
        </div>

        <div class="mb-1 row">
            <label class="col-sm-2 col-form-label">Téléphone</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" value="<?php echo ($info['telephone_client']); ?>" readonly>
            </div>
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
            <td colspan="5">TOTAL (sans <?php echo ($detail['remise'] . '% de remise)'); ?> </td>
            <td class="text-end"><b> <?php echo number_format($total, '0', '', ' ') . ' Ar'; ?> </b></td>
        </tr>
        <tr>
            <td colspan="3">Payement du <?php echo ($detail['date_facture_nuit']); ?></td>
            <td colspan="2"><?php echo ($detail['type_payement_nuit']); ?></td>
            <td class="text-end"> <?php echo number_format($montant, '0', '', ' ') . ' Ar'; ?> </td>
        </tr>
        <tr>
            <td colspan="5">RESTE A PAYER</td>
            <td class="text-end"><b> <?php echo number_format($reste, '0', '', ' ') . ' Ar'; ?> </b></td>
        </tr>
    </tbody>
</table>