<!--DASHBOARD ADMIN-->
<?php include("modal/modalReservationNuit.php"); ?>
<?php include("assets/toast/myToast.php"); ?>

<div class="container-fluid mt-3 mb-3 row">
    <!-- <h1>Liste des réservations nuitées</h1> -->

    <h1 class="col">
        <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
                <i class="fas fa-calendar-week"></i>
            </div>
            <div class="flex-grow-1 ms-3">
                Liste des réservations nuitées
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


    <div class="overflow-auto">
        <table class="table table-hover table-striped" id="result">
            <thead>
                <tr>
                    <th scope="col"><i class="fab fa-slack-hash"></i></th>
                    <th scope="col" class="text-end">Debut séjour</th>
                    <th scope="col" class="text-end">Fin séjour</th>
                    <th scope="col" class="text-end">Nuitées</th>
                    <th scope="col">Détails</th>
                    <th scope="col" class="text-start">Etat client</th>
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
                            <td class="text-end">
                                <div class="row">
                                    <div class="col"><?php echo ($reservation['nbr_nuit']) . ' nuitées'; ?></div>
                                    <div class="col-1 ms-2 center">
                                        <?php if ($reservation['etat'] == 1) echo ('<i class="fas fa-hourglass-start text-primary"></i>') ?>
                                        <?php if ($reservation['etat'] == 2) echo ('<i class="fas fa-hourglass-half text-success"></i>') ?>
                                        <?php if ($reservation['etat'] == 3) echo ('<i class="fas fa-hourglass-end text-secondary"></i>') ?>
                                    </div>
                                </div>

                            </td>
                            <td>
                                <div class="center">
                                    <div>
                                        <button type="button" class="btn btn-outline-primary btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalReservationInfo" id="infoDetails" onclick="infoSupplementaireNuit('<?php echo $reservation['ID_nuit']; ?>', 'infoDetails')"><i class="fas fa-money-check"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <!-- <div>
                                        <button type="button" class="btn btn-outline-secondary btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalReservationInfoClient" id="infoClient" onclick="infoSupplementaireNuit('<?php echo $reservation['ID_nuit']; ?>', 'infoClient')"><i class="fas fa-user"></i></button>
                                    </div>
                                    <div class="center me-1">
                                        <?php if ($reservation['ID_etat_reservation'] == 1 || $reservation['ID_etat_reservation'] == 4) echo ('<i class="fas fa-check text-secondary mx-3"></i>') ?>
                                        <?php if ($reservation['ID_etat_reservation'] == 2 || $reservation['ID_etat_reservation'] == 3) echo ('<i class="fas fa-exclamation-triangle text-danger mx-3"></i>') ?>
                                    </div>
                                    <div><?php echo ($reservation['nom_client']); ?></div> -->

                                    <div class="row">
                                        <div class="col-1 me-2 center">
                                            <?php if ($reservation['ID_etat_reservation'] == 1 || $reservation['ID_etat_reservation'] == 4) echo ('<i class="fas fa-check text-secondary mx-3"></i>') ?>
                                            <?php if ($reservation['ID_etat_reservation'] == 2 || $reservation['ID_etat_reservation'] == 3) echo ('<i class="fas fa-exclamation-triangle text-danger mx-3"></i>') ?>

                                        </div>
                                        <div class="col"><?php echo ($reservation['nom_client'] . ' ' . $reservation['prenom_client']); ?></div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="center">
                                    <div>
                                        <button type="button" class="btn btn-outline-secondary btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalReservationInfoNuit" id="infoReservation" onclick="infoSupplementaireNuit('<?php echo $reservation['ID_nuit']; ?>', 'infoNuit')"><i class="fas fa-users-cog"></i></button>
                                    </div>
                                    <div>
                                        <?php if ($reservation['ID_etat_reservation'] == 1 || $reservation['ID_etat_reservation'] == 2) echo ('<i class="fas fa-check text-secondary mx-3"></i>') ?>
                                        <?php if ($reservation['ID_etat_reservation'] == 3 || $reservation['ID_etat_reservation'] == 4) echo ('<i class="fas fa-exclamation-triangle text-danger mx-3"></i>') ?>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="center">
                                    <div>
                                        <button type="button" class="btn btn-outline-dark btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalReservationUpdate" onclick="infoSupplementaireNuit('<?php echo $reservation['ID_nuit']; ?>', 'updateNuit')"><i class="fas fa-pencil-alt"></i></button>
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

    <div class="row mb-4">
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
                    <i class="fas fa-hourglass-start text-primary"></i>
                </div>
                <div class="flex-grow-1 ms-2">
                    <?php echo ('En attente : ' . $enAttente) ?> </div>
            </div>
        </div>
        <div class="col-auto center">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-hourglass-half text-success"></i>
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
                    <?php echo ('Terminé : ' . $termine) ?> </div>
            </div>
        </div>
    </div>

</div>