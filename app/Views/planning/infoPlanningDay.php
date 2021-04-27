<?php
$total = 0;
foreach ($details as $detail) {
    $total = $total + ($detail['tarif_chambre'] * $detail['duree_day']);
}
$montant = $total;
$reste = $total - $montant;
?>

<div class="row">
    <div class="col">
        <h5 class="mt-3 mb-3">A propos de la réservation</h5>

        <div class="mb-1 row">
            <label for="#" class="col-sm-2 col-form-label">Date de réservation</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="#" value="<?php echo ($info['date_reservation_day'] . ' par ' . $info['nom_user']); ?>" readonly>
            </div>
        </div>

        <div class="mb-1 row">
            <label for="#" class="col-sm-2 col-form-label">Dernière modification</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="#" value="<?php echo ($info['date_modification_day'] . ' par ' . $info['nom_user_modif']); ?>" readonly>
            </div>
        </div>
    </div>
    <div class="col">
        <h5 class="mt-3 mb-3">A propos du client</h5>

        <div class="mb-1 row">
            <label for="#" class="col-sm-2 col-form-label">Nom</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="#" value="<?php echo ($info['nom_client_day']); ?>" readonly>
            </div>
        </div>


    </div>
</div>



<table class="table table-hover table-striped table-light mb-0">
    <thead>
        <tr>
            <th scope="col" class="text-end">Durée</th>
            <th scope="col">N°Chambre</th>
            <th scope="col" class="text-end">Prix Unitaire</th>
            <th scope="col" class="text-end">Total</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($details as $detail) { ?>
            <tr>
                <th scope="row" class="text-end"> <?php echo ($detail['duree_day'] . 'h'); ?> </th>
                <td class="text-center"> <?php echo ($detail['ID_chambre']); ?> </td>
                <td class="text-end"> <?php echo number_format($detail['tarif_chambre'], '2', ',', ' ') . ' Ar'; ?> </td>
                <td class="text-end"> <?php echo number_format($detail['tarif_chambre'] * $detail['duree_day'], '2', ',', ' ') . ' Ar'; ?> </td>
            </tr>
        <?php } ?>
        <tr>
            <td colspan="3">TOTAL</td>
            <td class="text-end"><b> <?php echo number_format($total, '2', ',', ' ') . ' Ar'; ?> </b></td>
        </tr>
        <tr>
            <td colspan="2">Payement du <?php echo ($detail['date_facture_day']); ?></td>
            <td colspan="1"><?php echo ($detail['type_payement_day']); ?></td>
            <td class="text-end"><?php echo number_format($montant, '2', ',', ' ') . ' Ar'; ?></td>
        </tr>
        <tr>
            <td colspan="3">RESTE A PAYER</td>
            <td class="text-end"><b><?php echo number_format($reste, '2', ',', ' ') . ' Ar'; ?></b></td>
        </tr>
    </tbody>
</table>