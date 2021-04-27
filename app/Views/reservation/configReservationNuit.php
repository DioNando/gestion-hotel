<!--DASHBOARD ADMIN-->
<?php include("modal/modalReservationNuit.php"); ?>
<?php include("assets/toast/myToast.php"); ?>

<div class="container-fluid mt-3 mb-3">
    <!-- <h1>Liste des réservations nuitées</h1> -->

    <h1>
        <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
                <i class="fas fa-calendar-week"></i>
            </div>
            <div class="flex-grow-1 ms-3">
                Liste des réservations nuitées
            </div>
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
                <th scope="col" class="text-end">Debut séjour</th>
                <th scope="col" class="text-end">Fin séjour</th>
                <th scope="col">Nuitées</th>
                <th scope="col">Détails</th>
                <th scope="col">Info client</th>
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
                        <th scope="row"> <?php echo ($reservation['ID_nuit']) ?> </th>
                        <td class="text-end"> <?php echo ($reservation['debut_sejour']); ?> </td>
                        <td class="text-end"> <?php echo ($reservation['fin_sejour']); ?> </td>
                        <th> <?php echo ($reservation['nbr_nuit']); ?> </th>
                        <td>
                            <div class="center">
                                <div>
                                    <button type="button" class="btn btn-outline-primary btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalReservationInfo" id="infoDetails" onclick="infoSupplementaireNuit('<?php echo $reservation['ID_nuit']; ?>', 'infoDetails')"><i class="fas fa-money-check"></i></button>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="center">
                                <div>
                                    <button type="button" class="btn btn-outline-secondary btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalReservationInfoClient" id="infoClient" onclick="infoSupplementaireNuit('<?php echo $reservation['ID_nuit']; ?>', 'infoClient')"><i class="fas fa-user"></i></button>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="center">
                                <div>
                                    <button type="button" class="btn btn-outline-success btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalReservationInfoNuit" id="infoReservation" onclick="infoSupplementaireNuit('<?php echo $reservation['ID_nuit']; ?>', 'infoNuit')"><i class="fas fa-users-cog"></i></button>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="center">
                                <div>
                                    <button type="button" class="btn btn-outline-warning btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalReservationUpdate" onclick="infoSupplementaireNuit('<?php echo $reservation['ID_nuit']; ?>', 'updateNuit')"><i class="fas fa-pencil-alt"></i></button>
                                    <button type="button" class="btn btn-outline-danger btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalReservationDelete" onclick="deleteData('<?php echo $reservation['ID_nuit']; ?>')"><i class="fas fa-trash-alt"></i></button>
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