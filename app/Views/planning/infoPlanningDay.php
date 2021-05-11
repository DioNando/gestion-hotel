<?php
$total = 0;
foreach ($details as $detail) {
    $total = $total + ($detail['tarif_chambre'] * $detail['duree_day']);
}
$montant = $total;
// $reste = $total - $montant;
$reste = $total - $detail['somme_donne_day'];
?>

<div class="row">
    <div class="col">
        <!-- <h5 class="mt-3 mb-3">A propos de la réservation</h5> -->

        <div class="mb-1 row">
            <label for="#" class="col-auto col-form-label">Création :</label>
            <div class="col">
                <input type="text" readonly class="form-control-plaintext" id="#" value="<?php echo ($info['date_reservation_day'] . ' par ' . $info['nom_user']); ?>" readonly>
            </div>
        </div>

    </div>
    <div class="col">
        <!-- <h5 class="mt-3 mb-3">A propos du client</h5> -->


        <div class="mb-1 row">
            <label for="#" class="col-auto col-form-label">Modification :</label>
            <div class="col">
                <input type="text" readonly class="form-control-plaintext" id="#" value="<?php echo ($info['date_modification_day'] . ' par ' . $info['nom_user_modif']); ?>" readonly>
            </div>
        </div>

    </div>

    <div class="col-12">
        <div class="mb-1 row">
            <label class="col-auto col-form-label">Commentaire :</label>
            <div class="col">
                <input type="text" class="form-control-plaintext" value="<?php echo ($info['commentaire_day']); ?>" readonly>
            </div>
        </div>
    </div>

    <div class="col">
        <!-- <h5 class="mt-3 mb-3">A propos de la réservation</h5> -->
        <div class="mb-1 row">
            <label class="col-auto col-form-label">Début :</label>
            <div class="col-auto">
                <input type="text" readonly class="form-control-plaintext" value="<?php echo ($info['heure_arrive']); ?>" readonly>
            </div>
        </div>

    </div>
    <div class="col">
        <!-- <h5 class="mt-3 mb-3">A propos du client</h5> -->
        <div class="mb-1 row">
            <label class="col-auto col-form-label">Fin :</label>
            <div class="col-auto">
                <input type="text" readonly class="form-control-plaintext" value="<?php echo ($info['heure_depart']); ?>" readonly>
            </div>
        </div>
    </div>

    <div class="container">
        <hr class="my-2">
    </div>


    <div class="col">
        <div class="mb-1 row">
            <label for="#" class="col-auto col-form-label">Nom :</label>
            <div class="col-auto">
                <input type="text" readonly class="form-control-plaintext" id="#" value="<?php echo ($info['nom_client_day']); ?>" readonly>
            </div>
        </div>
    </div>
</div>



<table class="table table-hover table-striped mb-0">
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
                <td class="text-end"> <?php echo number_format($detail['tarif_chambre'], '0', '', ' ') . ' Ar'; ?> </td>
                <td class="text-end"> <?php echo number_format($detail['tarif_chambre'] * $detail['duree_day'], '0', '', ' ') . ' Ar'; ?> </td>
            </tr>
        <?php } ?>
        <tr>
            <td colspan="3">TOTAL</td>
            <td class="text-end"><b> <?php echo number_format($total, '0', '', ' ') . ' Ar'; ?> </b></td>
        </tr>
        <tr>
            <td colspan="2">Payement du <?php echo ($detail['date_facture_day']); ?></td>
            <td colspan="1"><?php echo ($detail['type_payement_day']); ?></td>
            <td class="text-end"><?php echo number_format($detail['somme_donne_day'], '0', '', ' ') . ' Ar'; ?></td>
        </tr>
        <tr>
            <td colspan="3">RESTE A PAYER</td>
            <td class="text-end"><b><?php echo number_format($reste, '0', '', ' ') . ' Ar'; ?></b></td>
        </tr>
    </tbody>
</table>