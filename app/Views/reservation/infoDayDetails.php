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
                <th scope="row"> <?php echo ($detail['duree_day']); ?> </th>
                <td> <?php echo ($detail['ID_chambre']); ?> </td>
                <td> <?php echo ($detail['tarif_chambre']); ?> </td>
                <td> <?php echo ($detail['tarif_chambre'] * $detail['duree_day']); ?> </td>
            </tr>
        <?php } ?>
        <tr>
            <td colspan="3">TOTAL</td>
            <td><b> <?php echo ($total); ?> </b></td>
        </tr>
        <tr>
            <td colspan="2">Payement du <?php echo ($detail['date_modification_day']); ?></td>
            <td colspan="1">Espèce</td>
            <td><?php echo ($montant); ?></td>
        </tr>
        <tr>
            <td colspan="3">RESTE A PAYER</td>
            <td><b><?php echo ($reste); ?></b></td>
        </tr>
    </tbody>
</table>