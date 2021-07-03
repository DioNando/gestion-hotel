<!--DASHBOARD ADMIN-->
<?php include("modal/modalReservationDay.php"); ?>
<?php include("assets/toast/myToast.php"); ?>

<div class="container-fluid mt-3 mb-3 row">
    <!-- <h1>Liste des réservations day use</h1> -->

    <h1 class="col">
        <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
                <i class="fas fa-calendar-day"></i>
            </div>
            <div class="flex-grow-1 ms-3">
                Liste des réservations day use
            </div>
        </div>
    </h1>

    <h1 class="col-auto">
        <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
                <i class="fab fa-slack-hash"></i>
            </div>
            <div class="flex-grow-1 ms-3">
                <?php echo ('Total : ' . $total) ?> </div>
        </div>
    </h1>
</div>

<div class="container-fluid">

    <!-- <?php if (session()->get('update')) : ?>
        <div class="alert alert-success" role="alert">
            <?= session()->get('update') ?>
        </div>
    <?php endif; ?>
    <?php if (session()->get('delete')) : ?>
        <div class="alert alert-success" role="alert">
            <?= session()->get('delete') ?>
        </div>
    <?php endif; ?> -->
    <table class="table table-hover" id="result">
        <thead>
            <tr>
                <th scope="col"><i class="fab fa-slack-hash"></i></th>
                <th scope="col" class="text-end">Heure d'arrivée</th>
                <th scope="col" class="text-end">Heure de départ</th>
                <th scope="col" class="text-end">Durée</th>
                <th scope="col" class="text-end">Minuteur</th>
                <th scope="col">Détails</th>
                <th scope="col" class="text-start">Client</th>
                <th scope="col">Info réservation</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody class="align-middle">
            <?php
            if (count($reservations) > 0) {
                foreach ($reservations as $reservation) {
            ?>
                    <tr <?php if ($reservation['etat'] == 1) echo ('class="table-danger"') ?> <?php if ($reservation['etat'] == 2) echo ('class="table-primary"') ?> <?php if ($reservation['etat'] == 3) echo ('class=""') ?>>
                        <th scope="row"> <?php echo ($reservation['ID_day']) ?> </th>
                        <td class="text-end"> <?php echo ($reservation['heure_arrive']); ?> </td>
                        <td class="text-end"> <?php echo ($reservation['heure_depart']); ?> </td>
                        <td class="text-end">
                            <div class="row">
                                <div class="col"><?php echo ($reservation['duree_day'] . 'h'); ?></div>
                                <div class="col-1 ms-2 center">
                                    <?php if ($reservation['etat'] == 1) echo ('<i class="fas fa-hourglass-start text-danger"></i>') ?>
                                    <?php if ($reservation['etat'] == 2) echo ('<i class="fas fa-hourglass-half text-primary"></i>') ?>
                                    <?php if ($reservation['etat'] == 3) echo ('<i class="fas fa-hourglass-end text-secondary"></i>') ?>
                                </div>
                            </div>


                        </td>
                        <td class="text-end" id="<?php echo ($reservation['ID_day']) ?>"> </td>
                        <td>
                            <div class="center">
                                <div>
                                    <button type="button" class="btn btn-outline-primary btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalReservationInfo" onclick="infoSupplementaireDay('<?php echo $reservation['ID_day']; ?>', 'infoDetails')"><i class="fas fa-money-check"></i></button>
                                </div>
                            </div>
                        </td>
                        <td class="text-start"><?php echo ($reservation['nom_client_day']); ?></td>
                        <td>
                            <div class="center">
                                <div>
                                    <button type="button" class="btn btn-outline-secondary btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalReservationInfoDay" onclick="infoSupplementaireDay('<?php echo $reservation['ID_day']; ?>', 'infoDay')"><i class="fas fa-users-cog"></i></button>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="center">
                                <div class="row">
                                    <button type="button" class="col btn btn-outline-dark btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalReservationUpdate" onclick="infoSupplementaireDay('<?php echo $reservation['ID_day']; ?>', 'updateDay')"><i class="fas fa-pencil-alt"></i></button>
                                    <?php if (session()->get('isUser') == 'Administrateur') : ?>
                                        <button type="button" class="col btn btn-outline-danger btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalReservationDelete" onclick="deleteData('<?php echo $reservation['ID_day']; ?>')"><i class="fas fa-trash-alt"></i></button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php
                }
            } else {
                ?>
                <tr>
                    <?php if (session()->get('isUser') == 'Administrateur') : ?>
                        <td colspan="8">Tableau vide.</td>
                    <?php else : ?>
                        <td colspan="8">Tableau vide.</td>
                    <?php endif; ?>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

    <div class="row mb-4 flex__legend">
        <div class="col"><?= $pager->links('paginationResult', 'pagination') ?></div>
        <div class="col-auto center">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <i class="fab fa-slack-hash"></i>
                </div>
                <div class="flex-grow-1 ms-2">
                    <?php echo ('Total : ' . $total_all) ?> </div>
            </div>
        </div>
        <div class="col-auto center">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-hourglass-start text-danger"></i>
                </div>
                <div class="flex-grow-1 ms-2">
                    <?php echo ('En attente : ' . $enAttente) ?> </div>
            </div>
        </div>
        <div class="col-auto center">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-hourglass-half text-primary"></i>
                </div>
                <div class="flex-grow-1 ms-2">
                    <?php echo ('En cours : ' . $enCours) ?> </div>
            </div>
        </div>
        <div class="col-auto center">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-hourglass-end text-secondary"></i>
                </div>
                <div class="flex-grow-1 ms-2">
                    <?php echo ('Terminée : ' . $termine) ?> </div>
            </div>
        </div>
    </div>

</div>

<script>
    window.onload = function chargementPage() {
        $(document).ready(function() {
            <?php
            if (count($reservations) > 0) {
                foreach ($reservations as $reservation) {
            ?>
                    if ("<?php echo ($reservation['reste']) ?>" !== "00:00:00") {
                        showDate<?php echo ($reservation['ID_day']) ?>();
                    }
            <?php }
            } ?>
        });
    }

    <?php
    if (count($reservations) > 0) {
        foreach ($reservations as $reservation) {
    ?>
            if ("<?php echo ($reservation['reste']) ?>" !== "00:00:00") {
                var temp = "<?php echo ($reservation['reste']); ?>";
                var y = temp.split(':');

                let left<?php echo ($reservation['ID_day']) ?> = parseInt(y[0]) * 3600 + parseInt(y[1]) * 60 + parseInt(y[2]);

                function refresh<?php echo ($reservation['ID_day']) ?>() {
                    setTimeout('showDate<?php echo ($reservation['ID_day']) ?>()', 1000);
                }

                function showDate<?php echo ($reservation['ID_day']) ?>() {

                    left<?php echo ($reservation['ID_day']) ?> = left<?php echo ($reservation['ID_day']) ?> - 1;
                    var time = left<?php echo ($reservation['ID_day']) ?>;
                    time = Math.trunc(time / 3600) + ":" + Math.trunc(((time / 3600) - Math.trunc(time / 3600)) * 60);

                    document.getElementById('<?php echo ($reservation['ID_day']) ?>').innerHTML = time;
                    refresh<?php echo ($reservation['ID_day']) ?>()
                }
            }
    <?php }
    } ?>
</script>