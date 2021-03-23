<!--DASHBOARD ADMIN-->
<?php include("modal/modalReservation.php"); ?>

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
                <th scope="col">Client</th>
                <th scope="col">Debut séjour</th>
                <th scope="col">Fin séjour</th>
                <th scope="col">Utilisateur</th>
                <?php if (session()->get('isUser') == 'Administrateur') : ?>
                    <th scope="col">Actions</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody class="align-middle">
            <?php
            if (count($reservations) > 0) {

                foreach ($reservations as $reservation) {

            ?>
                    <tr>
                        <th scope="row"> <?php echo ($reservation['ID_reservation']) ?> </th>
                        <td> <?php echo ($reservation['ID_client']); ?> </td>
                        <td> <?php echo ($reservation['debut_sejour']); ?> </td>
                        <td> <?php echo ($reservation['fin_sejour']); ?> </td>
                        <td> <?php echo ($reservation['ID_user']); ?> </td>
                        <td>
                            <div class="center">
                                <div>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalReservationUpdate" onclick="updateData('<?php echo $reservation['ID_reservation']; ?>' , '<?php echo $reservation['ID_client']; ?>' , '<?php echo $reservation['ID_user']; ?>')"><img src="assets/icons/pencil-fill.svg" alt="Modifier"></button>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalReservationDelete" onclick="deleteData('<?php echo $reservation['ID_reservation']; ?>')"><img src="assets/icons/eraser-fill.svg" alt="Supprimer"></button>
                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalReservationInfo" onclick="infoData('<?php echo $reservation['ID_reservation']; ?>')"><img src="assets/icons/info-circle-fill.svg" alt="Info"></button>
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
                        <td colspan="5">Tableau vide.</td>
                    <?php endif; ?>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>



</div>