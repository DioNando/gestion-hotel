<?php
$total = 0;
foreach ($details as $detail) {
    $total = $total + ($detail['tarif_chambre'] * $detail['duree_day']);
}
$montant = $total;
$reste = $total - $montant;
?>

<table class="table table-hover table-striped table-light mb-0">
    <thead>
        <tr>
            <th scope="col">Durée</th>
            <th scope="col">N°Chambre</th>
            <th scope="col">Prix Unitaire</th>
            <th scope="col">Total</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($details as $detail) { ?>
            <tr>
                <th scope="row"> <?php echo ($detail['duree_day'] . 'h'); ?> </th>
                <td> <?php echo ($detail['ID_chambre']); ?> </td>
                <td> <?php echo number_format($detail['tarif_chambre'], '2', ',', ' ') . ' Ar'; ?> </td>
                <td> <?php echo number_format($detail['tarif_chambre'] * $detail['duree_day'], '2', ',', ' ') . ' Ar'; ?> </td>
            </tr>
        <?php } ?>
        <tr>
            <td colspan="3">TOTAL</td>
            <td><b> <?php echo number_format($total, '2', ',', ' ') . ' Ar'; ?> </b></td>
        </tr>
        <tr>
            <td colspan="2">Payement du <?php echo ($detail['date_facture_day']); ?></td>
            <td colspan="1"><?php echo ($detail['type_payement_day']); ?></td>
            <td><?php echo number_format($montant, '2', ',', ' ') . ' Ar'; ?></td>
        </tr>
        <tr>
            <td colspan="3">RESTE A PAYER</td>
            <td><b><?php echo number_format($reste, '2', ',', ' ') . ' Ar'; ?></b></td>
        </tr>
    </tbody>
</table>