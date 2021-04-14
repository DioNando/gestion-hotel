<!--DASHBOARD ADMIN-->
<?php include("modal/modalReservationDay.php"); ?>

<div class="container-fluid mt-3 mb-3">
    <h1>Liste des réservations passagères</h1>
</div>

<div class="container-fluid">

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
                <th scope="col">Heure d'arrivée</th>
                <th scope="col">Heure de départ</th>
                <th scope="col">Durée</th>
                <th scope="col">Détails</th>
                <th scope="col">Client</th>
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
                        <td> <?php echo ($reservation['heure_arrive']); ?> </td>
                        <td> <?php echo ($reservation['heure_depart']); ?> </td>
                        <td> <?php echo ($reservation['duree_day'] . 'h');?> </td>
                        <td>
                            <div class="center">
                                <div>
                                    <button type="button" class="btn btn-outline-primary btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalReservationInfo" onclick="infoSupplementaireDay('<?php echo $reservation['ID_day']; ?>', 'infoDetails')"><img src="assets/icons/info-circle-fill.svg" alt="Info"></button>
                                </div>
                            </div>
                        </td>
                        <td><b> <?php echo ($reservation['nom_client_day']); ?> </b></td>
                        <td>
                            <div class="center">
                                <div>
                                    <button type="button" class="btn btn-outline-success btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalReservationInfoDay" onclick="infoSupplementaireDay('<?php echo $reservation['ID_day']; ?>', 'infoDay')"><img src="assets/icons/stickies-fill.svg" alt="Info"></button>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="center">
                                <div>
                                    <button type="button" class="btn btn-outline-warning btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalReservationUpdate" onclick="infoSupplementaireDay('<?php echo $reservation['ID_day']; ?>', 'updateDay')"><img src="assets/icons/pencil-fill.svg" alt="Modifier"></button>
                                    <button type="button" class="btn btn-outline-danger btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalReservationDelete" onclick="deleteData('<?php echo $reservation['ID_day']; ?>')"><img src="assets/icons/eraser-fill.svg" alt="Supprimer"></button>
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
