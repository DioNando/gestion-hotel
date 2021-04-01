<!--DASHBOARD ADMIN-->
<?php include("modal/modalReservationNuit.php"); ?>

<div class="container-fluid mt-3">


    <h1>Liste des réservations</h1>

    <?php include("search/recherche.php"); ?>
    <?php if (session()->get('update')) : ?>
        <div class="alert alert-success" role="alert">
            <?= session()->get('update') ?>
        </div>
    <?php endif; ?>
    <?php if (session()->get('delete')) : ?>
        <div class="alert alert-success" role="alert">
            <?= session()->get('delete') ?>
        </div>
    <?php endif; ?>
    <table class="table table-hover table-striped table-light" id="result">
        <thead>
            <tr>
                <th scope="col">Identification</th>
                <th scope="col">Debut séjour</th>
                <th scope="col">Fin séjour</th>
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
                        <td> <?php echo ($reservation['debut_sejour']); ?> </td>
                        <td> <?php echo ($reservation['fin_sejour']); ?> </td>
                        <th> <?php echo ($reservation['nbr_nuit']); ?> </th>
                        <td>
                            <div class="center">
                                <div>
                                    <button type="button" class="btn btn-outline-primary btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalReservationInfo" onclick="infoData('<?php echo $reservation['ID_nuit']; ?>')"><img src="assets/icons/info-circle-fill.svg" alt="Info"></button>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="center">
                                <div>
                                    <button type="button" class="btn btn-outline-secondary btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalReservationInfoClient" id="infoClient" onclick="infoSupplementaireNuit('<?php echo $reservation['ID_nuit']; ?>', 'infoClient')"><img src="assets/icons/people-fill.svg" alt="Info"></button>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="center">
                                <div>
                                    <button type="button" class="btn btn-outline-success btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalReservationInfoNuit" id="infoReservation" onclick="infoSupplementaireNuit('<?php echo $reservation['ID_nuit']; ?>', 'infoNuit')"><img src="assets/icons/stickies-fill.svg" alt="Info"></button>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="center">
                                <div>
                                    <button type="button" class="btn btn-outline-warning btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalReservationUpdate" onclick="updateData('<?php echo $reservation['ID_nuit']; ?>' , '<?php echo $reservation['ID_client']; ?>' , '<?php echo $reservation['ID_user']; ?>')"><img src="assets/icons/pencil-fill.svg" alt="Modifier"></button>
                                    <button type="button" class="btn btn-outline-danger btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalReservationDelete" onclick="deleteData('<?php echo $reservation['ID_nuit']; ?>')"><img src="assets/icons/eraser-fill.svg" alt="Supprimer"></button>
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
                        <td colspan="6">Tableau vide.</td>
                    <?php else : ?>
                        <td colspan="6">Tableau vide.</td>
                    <?php endif; ?>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>



</div>


