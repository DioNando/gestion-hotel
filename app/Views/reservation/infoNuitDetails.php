<?php
$total = 0;
foreach ($details as $detail) {
    $total = $total + ($detail['tarif_chambre'] * $detail['nbr_nuit']);
}
$montant = $total - $detail['remise'] * $total / 100;
$reste = $total - $total;
?>

<table class="table table-hover table-striped table-light mb-0">
    <thead>
        <tr>
            <th scope="col">Nuitée</th>
            <th scope="col">Date</th>
            <th scope="col">N°Chambre</th>
            <th scope="col">Prix Unitaire</th>
            <th scope="col">Lit supplémentaire</th>
            <th scope="col">Total</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($details as $detail) { ?>
            <tr>
                <th scope="row"> <?php echo ($detail['nbr_nuit']); ?> </th>
                <td> <?php echo ($detail['debut_sejour']); ?> </td>
                <td> <?php echo ($detail['ID_chambre']); ?> </td>
                <td> <?php echo number_format($detail['tarif_chambre'], '2', ',', ' ') . ' Ar'; ?> </td>
                <td> <?php echo ('0'); ?> </td>
                <td> <?php echo number_format($detail['tarif_chambre'] * $detail['nbr_nuit'], '2', ',', ' ') . ' Ar'; ?> </td>
            </tr>
        <?php } ?>


        <tr>
            <td colspan="5">TOTAL (sans <?php echo ($detail['remise'] . '% de remise)'); ?> </td>
            <td><b> <?php echo number_format($total, '2', ',', ' ') . ' Ar'; ?> </b></td>
        </tr>
        <tr>
            <td colspan="3">Payement du <?php echo ($detail['date_facture_nuit']); ?></td>
            <td colspan="2"><?php echo ($detail['type_payement_nuit']); ?></td>
            <td> <?php echo number_format($montant, '2', ',', ' ') . ' Ar'; ?> </td>
        </tr>
        <tr>
            <td colspan="5">RESTE A PAYER</td>
            <td><b> <?php echo number_format($reste, '2', ',', ' ') . ' Ar'; ?> </b></td>
        </tr>
    </tbody>
</table>