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
    <table class="table table-hover table-striped table-light" id="result">
        <thead>
            <tr>
                <th scope="col"><i class="fab fa-slack-hash"></i></th>
                <th scope="col" class="text-end">Heure d'arrivée</th>
                <th scope="col" class="text-end">Heure de départ</th>
                <th scope="col" class="text-end">Durée</th>
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
                    <tr>
                        <th scope="row"> <?php echo ($reservation['ID_day']) ?> </th>
                        <td class="text-end"> <?php echo ($reservation['heure_arrive']); ?> </td>
                        <td class="text-end"> <?php echo ($reservation['heure_depart']); ?> </td>
                        <td class="text-end"> <?php echo ($reservation['duree_day'] . 'h'); ?> </td>
                        <td>
                            <div class="center">
                                <div>
                                    <button type="button" class="btn btn-outline-primary btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalReservationInfo" onclick="infoSupplementaireDay('<?php echo $reservation['ID_day']; ?>', 'infoDetails')"><i class="fas fa-money-check"></i></button>
                                </div>
                            </div>
                        </td>
                        <td class="text-start"><b> <?php echo ($reservation['nom_client_day']); ?> </b></td>
                        <td>
                            <div class="center">
                                <div>
                                    <button type="button" class="btn btn-outline-success btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalReservationInfoDay" onclick="infoSupplementaireDay('<?php echo $reservation['ID_day']; ?>', 'infoDay')"><i class="fas fa-users-cog"></i></button>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="center">
                                <div>
                                    <button type="button" class="btn btn-outline-warning btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalReservationUpdate" onclick="infoSupplementaireDay('<?php echo $reservation['ID_day']; ?>', 'updateDay')"><i class="fas fa-pencil-alt"></i></button>
                                    <button type="button" class="btn btn-outline-danger btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalReservationDelete" onclick="deleteData('<?php echo $reservation['ID_day']; ?>')"><i class="fas fa-trash-alt"></i></button>
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


</div>