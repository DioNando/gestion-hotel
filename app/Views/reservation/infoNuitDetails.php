<?php
$total = 0;
foreach ($details as $detail) {
    $total = $total + ($detail['tarif_chambre'] * $detail['nbr_nuit'] + $detail['lit_sup'] * $detail['tarif_lit_sup']);
}
$montant = $total - $detail['remise'] * $total / 100;
$reste = $total - $total;
?>

<table class="table table-hover table-striped mb-0">
    <thead>
        <tr>
            <th scope="col">Nuitée</th>
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
                <th scope="row"> <?php echo ($detail['nbr_nuit']); ?> </th>
                <td class="text-end"> <?php echo ($detail['debut_sejour']); ?> </td>
                <td class="text-center"> <?php echo ($detail['ID_chambre']); ?> </td>
                <td class="text-end"> <?php echo number_format($detail['tarif_chambre'], '0', '', ' ') . ' Ar'; ?> </td>
                <td class="text-center"> <?php echo number_format($detail['lit_sup'] * $detail['tarif_lit_sup'], '0', '', ' ') . ' Ar'; ?> </td>
                <td class="text-end"> <?php echo number_format($detail['tarif_chambre'] * $detail['nbr_nuit'] + $detail['lit_sup'] * $detail['tarif_lit_sup'], '0', '', ' ') . ' Ar'; ?> </td>
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