<!--DASHBOARD ADMIN-->
<?php include("modal/modalChambre.php"); ?>
<?php include("modal/modalNouveau.php"); ?>
<?php include("assets/toast/myToast.php"); ?>

<div class="container-fluid mt-3 mb-3 row">
    <!-- <h1>Liste des chambres</h1> -->

    <h1 class="col">
        <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
                <i class="fas fa-clipboard-list"></i>
            </div>
            <div class="flex-grow-1 ms-3">
                Liste des chambres
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

<!-- <div class="container-fluid">
    <div class="d-flex justify-content-between">
        <div class="">
            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target=".multi-collapse" aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2">Liste actuelle</button>
        </div>
        <div class="">
            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target=".multi-collapse" aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2">Modification</button>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="collapse multi-collapse" id="multiCollapseExample1">
                <div class="card card-body">
                    Some placeholder content for the first collapse component of this multi-collapse example. This panel is hidden by default but revealed when the user activates the relevant trigger.
                </div>
            </div>
        </div>
        <div class="col">
            <div class="collapse multi-collapse" id="multiCollapseExample2">
                <div class="card card-body">
                    Some placeholder content for the second collapse component of this multi-collapse example. This panel is hidden by default but revealed when the user activates the relevant trigger.
                </div>
            </div>
        </div>
    </div>

</div> -->


<div class="container-fluid">


    <?php include("search/recherche.php"); ?>
    <!-- <?php if (session()->get('success')) : ?>
        <div class="alert alert-success" role="alert">
            <?= session()->get('success') ?>
        </div>
    <?php endif; ?>
    <?php if (session()->get('update')) : ?>
        <div class="alert alert-success" role="alert">
            <?= session()->get('update') ?>
        </div>
    <?php endif; ?>
    <?php if (session()->get('delete')) : ?>
        <div class="alert alert-success" role="alert">
            <?= session()->get('delete') ?>
        </div>
    <?php endif; ?> -->
    <table class="table table-hover table-striped" id="result">
        <thead>
            <tr>
                <th scope="col"><i class="fab fa-slack-hash"></i></th>
                <th scope="col" class="text-start">Numéro</th>
                <th scope="col" class="text-start">Description</th>
                <th scope="col" class="text-start">Statut chambre</th>
                <th scope="col" class="text-end">Tarif actuel</th>
                <?php if (session()->get('isUser') == 'Administrateur') : ?>
                    <!-- <th scope="col">Actions</th> -->
                <?php endif; ?>

            </tr>
        </thead>
        <tbody class="align-middle">
            <?php
            if (count($chambres) > 0) {

                foreach ($chambres as $chambre) {

            ?>
                    <tr>
                        <th scope="row"> <?php echo ($chambre['ID_chambre']) ?> </th>
                        <th scope="row" class="text-start"> <?php echo ($chambre['num_chambre']) ?> </th>
                        <td>
                            <div class="d-flex align-items-center"> <?php echo ($chambre['description_chambre']) ?> </div>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-1 ms-2 center">
                                    <?php if ($chambre['statut_chambre'] == 'Libre') { ?><button type="button" class="btn btn-outline-success btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalChambreUpdate" onclick="updateStatut('<?php echo $chambre['ID_chambre']; ?>' ,'update')"><i class="fas fa-tag"></i></button><?php } ?>
                                    <?php if ($chambre['statut_chambre'] == 'En attente') { ?><button type="button" class="btn btn-outline-danger btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalChambreUpdate" onclick="updateStatut('<?php echo $chambre['ID_chambre']; ?>' ,'update')"><i class="fas fa-exclamation-triangle"></i></button><?php } ?>
                                    <?php if ($chambre['statut_chambre'] == 'Occupée') { ?><button type="button" class="btn btn-outline-secondary btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalChambreUpdate" onclick="updateStatut('<?php echo $chambre['ID_chambre']; ?>' ,'update')"><i class="fas fa-house-user"></i></button><?php } ?>



                                    <!-- <?php if ($chambre['statut_chambre'] == 'Libre') echo ('<i class="fas fa-tag text-success"></i>') ?> -->
                                    <!-- <?php if ($chambre['statut_chambre'] == 'En attente') echo ('<i class="fas fa-exclamation-triangle text-danger"></i>') ?> -->
                                    <!-- <?php if ($chambre['statut_chambre'] == 'Occupée') echo ('<i class="fas fa-house-user text-secondary"></i>') ?> -->
                                </div>
                                <div class="col text-start d-flex align-items-center"><?php echo ($chambre['statut_chambre']) ?></div>
                            </div>

                        </td>
                        <td class="text-end"> <?php echo number_format($chambre['tarif_chambre'], '0', '', ' ') . ' Ar' ?> </td>
                        <?php if (session()->get('isUser') == 'Administrateur') : ?>
                            <!-- <td>
                                <div class="center">
                                    <div>
                                        <button type="button" class="btn btn-outline-dark btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalChambreUpdate" onclick="updateChambre('<?php echo $chambre['ID_chambre']; ?>' ,'update')"><i class="fas fa-pencil-alt"></i></button>
                                        <button type="button" class="btn btn-outline-danger btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalChambreDelete" onclick="deleteData('<?php echo $chambre['ID_chambre']; ?>')"><i class="fas fa-trash-alt"></i></button>
                                    </div>
                                </div>
                            </td> -->
                        <?php endif; ?>
                    </tr>
                <?php
                }
            } else {
                ?>
                <tr>
                    <?php if (session()->get('isUser') == 'Administrateur') : ?>
                        <td colspan="5">Tableau vide.</td>
                    <?php else : ?>
                        <td colspan="5">Tableau vide.</td>
                    <?php endif; ?>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

    <div class="position-fixed bottom-0 end-0 p-4" style="z-index: 5">
        <div id="myToastSave" class="toast hide border" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <!-- <img src="assets/icons/stickies-fill.svg" class="me-2" alt="..."> -->
                <strong class="me-auto">Réussi</strong>
                <!-- <small>Modification</small> -->
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body alert alert-success alert-toast" role="alert">
                Les nouveaux tarifs ont été enregistré
            </div>

        </div>
    </div>



    <script>
        let dataChambre = <?php echo ($jsonChambre) ?>;
        let obj = JSON.stringify(dataChambre);

        function chambreJSON() {
            $(document).ready(function() {
                $.ajax({
                    url: 'saveTarif',
                    type: 'POST',
                    // dataType: 'JSON',
                    data: {
                        dataJSON: obj,
                    },

                    success: function(result) {
                        console.log(result);
                        $(document).ready(function() {
                            $("#modalTarifSave").modal('hide');
                            $("#myToastSave").toast('show');
                        });
                    },
                    error: function() {
                        alert('Erreur');
                    },
                })
            });
        }
    </script>



    <!-- <form action="saveTarif" method="post"> -->

    <!-- </form> -->

    <div class="row mb-4 mt-3">
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
                    <i class="fas fa-tag text-success"></i>
                </div>
                <div class="flex-grow-1 ms-2">
                    <?php echo ('Libre : ' . $libre) ?> </div>
            </div>
        </div>
        <div class="col-auto center">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-triangle text-danger"></i>
                </div>
                <div class="flex-grow-1 ms-2">
                    <?php echo ('En attente : ' . $enAttente) ?> </div>
            </div>
        </div>
        <div class="col-auto center">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-house-user text-secondary"></i>
                </div>
                <div class="flex-grow-1 ms-2">
                    <?php echo ('Occupée : ' . $occupee) ?> </div>
            </div>
        </div>
    </div>

</div>