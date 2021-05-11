<?php include("modal/modalPlanning.php"); ?>
<?php include("assets/toast/myToast.php"); ?>
<?php include("modal/modalChambre.php"); ?>

<div class="container-fluid mt-3 mb-3">
    <!-- <h1>Planning du Jour</h1> -->

    <h1>
        <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
                <i class="fas fa-calendar-check"></i>
            </div>
            <div class="flex-grow-1 ms-3">
                Planning du Jour
            </div>
        </div>
    </h1>
</div>

<script>
    function planningDisplay(result) {
        console.log(result);

        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            // themeSystem: 'bootstrap',
            schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
            locale: 'fr',
            initialView: 'listWeek',
            headerToolbar: {
                left: 'listWeek,timeGridWeek,dayGridMonth',
                center: 'title',
                right: 'today prev,next',
            },
            buttonText: {
                today: 'Aujourd\'hui',
                month: 'Mois',
                week: 'Semaine',
                day: 'Jour',
                list: 'Liste',

            },
            events: result,
            eventClick: function(info) {

                let ID_unique, motif_unique;
                let ID_reservation = result.map(function(e) {
                    if (e.id == info.event.id) {
                        ID_unique = e.ID_reservation;
                        motif_unique = e.motif;
                        return e.ID_reservation;
                    }
                });

                // alert('Event: ' + ID_unique + motif_unique);

                $(document).ready(function() {
                    $.ajax({
                        url: 'ajaxPlanning',
                        type: 'post',
                        data: {
                            ID_planning: info.event.id,
                            ID_reservation: ID_unique,
                            motif: motif_unique
                        },

                        success: function(result) {
                            $('#modalPlanningJour').html(result);
                        }
                    })
                    $('#modalPlanning').modal('show');

                });
            }


        });
        calendar.render();


    }

    function calendrierData() {
        $.ajax({
            url: 'Planning',
            type: 'post',
            dataType: 'JSON',
            data: {
                planning: 'planning'
            },

            success: function(data) {
                planningDisplay(data);
            }
        })
    }
</script>

<!-- AJAX POUR AFFICHER LE TABLEAU -->

<script>
    function tabPlanningJour() {
        $(document).ready(function() {

            // if (info == 'infoDay') {
            $.ajax({
                url: 'tabPlanningJour',
                type: 'post',
                // dataType: 'JSON',

                success: function(data) {
                    $('#tabPlanningJour').html(data);
                    // console.log(data);
                }
            })
            // }
        });
    }
</script>

<script>
    window.onload = function chargementPage() {
        calendrierData();
        // document.getElementById('calendar').style.opacity = 1;        
    }
</script>

<div class="container-fluid" style="overflow-x:auto;">
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th scope="col">N° des chambres</th>
                <th scope="col">Motif</th>
                <th scope="col" class="text-start">Client</th>
                <th scope="col" class="text-end">Date d'arrivé</th>
                <th scope="col" class="text-end">Date départ</th>
                <th scope="col">Durée</th>
                <th scope="col" class="text-start">Commentaire</th>
                <th scope="col" class="text-end">Montant</th>
                <th scope="col" class="text-end">Surplus</th>
                <th scope="col" class="text-end">Total</th>
            </tr>
        </thead>
        <tbody class="align-middle">

            <?php
            if (count($plannings) > 0) {
                foreach ($plannings as $planning) { ?>

                    <tr>
                        <th scope="row">
                            <div class="row">
                                <div class="col d-flex justify-content-start center ms-4"><?php echo ($planning['ID_chambre']); ?></div>
                                <div class="col d-flex justify-content-end center me-4">
                                    <?php if ($planning['statut_chambre'] == 'Libre') { ?><button type="button" class="btn btn-outline-success btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalChambreUpdate" onclick="updateStatut('<?php echo $planning['ID_chambre']; ?>' ,'update')"><i class="fas fa-tag"></i></button><?php } ?>
                                    <?php if ($planning['statut_chambre'] == 'En attente') { ?><button type="button" class="btn btn-outline-danger btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalChambreUpdate" onclick="updateStatut('<?php echo $planning['ID_chambre']; ?>' ,'update')"><i class="fas fa-exclamation-triangle"></i></button><?php } ?>
                                    <?php if ($planning['statut_chambre'] == 'Occupée') { ?><button type="button" class="btn btn-outline-secondary btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalChambreUpdate" onclick="updateStatut('<?php echo $planning['ID_chambre']; ?>' ,'update')"><i class="fas fa-house-user"></i></button><?php } ?>
                                </div>
                            </div>

                        </th>
                        <!-- <td class="text-start"><?php echo ($planning['motif']); ?></td> -->
                        <td class="text-center">
                            <?php if ($planning['motif'] == 'Nuitée') echo ('<i class="fas fa-moon text-dark"></i>') ?>
                            <?php if ($planning['motif'] == 'Day use') echo ('<i class="fas fa-sun text-secondary"></i>') ?>
                        </td>
                        <td><?php echo ($planning['nom']); ?></td>
                        <td class="text-end"><?php echo ($planning['debut']); ?></td>
                        <td class="text-end"><?php echo ($planning['fin']); ?></td>
                        <td class="text-center"><?php echo ($planning['duree']); ?></td>
                        <td><?php echo ($planning['commentaire']); ?></td>
                        <td class="text-end"><?php echo number_format($planning['montant'], '0', '', ' ') . ' Ar'; ?></td>
                        <td class="text-end">


                            <div class="row">
                                <div class="col d-flex align-items-center justify-content-end"> <?php echo number_format($planning['surplus'], '0', '', ' ') . ' Ar'; ?></div>
                                <div class="col-1 center">
                                    <?php if ($planning['statut_chambre'] == 'Libre') { ?>
                                        <button disabled type="button" class="btn btn-outline-dark btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalChambreUpdate" onclick="updateChambreReservation('<?php echo $planning['ID_chambre']; ?>', '<?php echo $planning['ID_planning']; ?>', 'update')"><i class="fas fa-bed"></i></button>
                                        <!-- <button disabled type="button" class="btn btn-outline-secondary btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalChambreInfo" onclick="infoData('<?php echo $planning['ID_chambre']; ?>')"><i class="fas fa-user"></i></button> -->
                                    <?php  } ?>
                                    <?php if ($planning['statut_chambre'] == 'En attente' || $planning['statut_chambre'] == 'Occupée') { ?>
                                        <button type="button" class="btn btn-outline-dark btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalChambreUpdateReservation" onclick="updateChambreReservation('<?php echo $planning['ID_chambre']; ?>', '<?php echo $planning['ID_planning']; ?>', 'update')"><i class="fas fa-bed"></i></button>
                                        <!-- <button type="button" class="btn btn-outline-secondary btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalChambreInfo" onclick="infoData('<?php echo $planning['ID_chambre']; ?>')"><i class="fas fa-user"></i></button> -->
                                    <?php  } ?>
                                </div>
                            </div>

                        </td>
                        <td class="text-end"><?php echo number_format($planning['total'], '0', '', ' ') . ' Ar'; ?></td>

                    <?php
                }
            } else {
                    ?>
                    <tr>
                        <?php if (session()->get('isUser') == 'Administrateur') : ?>
                            <td colspan="10">Tableau vide.</td>
                        <?php else : ?>
                            <td colspan="10">Tableau vide.</td>
                        <?php endif; ?>
                    </tr>
                <?php
            }
                ?>
        </tbody>
    </table>

</div>

<!-- <div class="container-fluid" style="overflow-x:auto;">
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th scope="col">N° des chambres</th>
                <th scope="col">Motif</th>
                <th scope="col" class="text-start">Client</th>
                <th scope="col" class="text-end">Date d'arrivé</th>
                <th scope="col" class="text-end">Date départ</th>
                <th scope="col">Durée</th>
                <th scope="col" class="text-start">Commentaire</th>
                <th scope="col" class="text-end">Montant</th>
                <th scope="col" class="text-end">Surplus</th>
                <th scope="col" class="text-end">Total</th>
            </tr>
        </thead>
        <tbody class="align-middle">

            <?php
            if (count($plannings) > 0) {
                foreach ($plannings as $planning) {
                    if ($planning['statut_chambre'] == 'Libre') { ?>

                        <tr class="my-5">
                            <th scope="row">
                                <div class="row">
                                    <div class="col d-flex justify-content-start center ms-4"><?php echo ($planning['ID_chambre']); ?></div>
                                    <div class="col d-flex justify-content-end center me-4">
                                        <?php if ($planning['statut_chambre'] == 'Libre') { ?><button type="button" class="btn btn-outline-success btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalChambreUpdate" onclick="updateStatut('<?php echo $planning['ID_chambre']; ?>' ,'update')"><i class="fas fa-tag"></i></button><?php } ?>
                                    </div>
                                </div>

                            </th>

                            <td class="text-center">
                                <?php if ($planning['motif'] == 'Nuitée') echo ('<i class="fas fa-moon text-dark"></i>') ?>
                                <?php if ($planning['motif'] == 'Day use') echo ('<i class="fas fa-sun text-secondary"></i>') ?>
                            </td>
                            <td><?php echo ($planning['nom']); ?></td>
                            <td class="text-end"><?php echo ($planning['debut']); ?></td>
                            <td class="text-end"><?php echo ($planning['fin']); ?></td>
                            <td class="text-center"><?php echo ($planning['duree']); ?></td>
                            <td><?php echo ($planning['commentaire']); ?></td>
                            <td class="text-end"><?php echo number_format($planning['montant'], '0', '', ' ') . ' Ar'; ?></td>
                            <td class="text-end">


                                <div class="row">
                                    <div class="col d-flex align-items-center justify-content-end"> <?php echo number_format($planning['surplus'], '0', '', ' ') . ' Ar'; ?></div>
                                    <div class="col-1 center">
                                        <?php if ($planning['statut_chambre'] == 'Libre') { ?>
                                            <button disabled type="button" class="btn btn-outline-dark btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalChambreUpdate" onclick="updateChambreReservation('<?php echo $planning['ID_chambre']; ?>', '<?php echo $planning['ID_planning']; ?>', 'update')"><i class="fas fa-bed"></i></button>
                                        <?php  } ?>
                                        <?php if ($planning['statut_chambre'] == 'En attente' || $planning['statut_chambre'] == 'Occupée') { ?>
                                            <button type="button" class="btn btn-outline-dark btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalChambreUpdateReservation" onclick="updateChambreReservation('<?php echo $planning['ID_chambre']; ?>', '<?php echo $planning['ID_planning']; ?>', 'update')"><i class="fas fa-bed"></i></button>
                                        <?php  } ?>
                                    </div>
                                </div>

                            </td>
                            <td class="text-end"><?php echo number_format($planning['total'], '0', '', ' ') . ' Ar'; ?></td>

                    <?php
                    }
                }
            } else {
                    ?>
                        <tr>
                            <?php if (session()->get('isUser') == 'Administrateur') : ?>
                                <td colspan="10">Tableau vide.</td>
                            <?php else : ?>
                                <td colspan="10">Tableau vide.</td>
                            <?php endif; ?>
                        </tr>
                    <?php
                }
                    ?>
        </tbody>
    </table>

</div> -->



<div class="container-fluid mb-4" id='calendar'></div>