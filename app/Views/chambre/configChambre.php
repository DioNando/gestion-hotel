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
                <th scope="col" class="text-start">Description</th>
                <th scope="col" class="text-end">Tarif (Ar)</th>
                <th scope="col" class="text-start">Statut chambre</th>
                <?php if (session()->get('isUser') == 'Administrateur') : ?>
                    <th scope="col">Actions</th>
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
                        <td> <?php echo ($chambre['description_chambre']) ?> </td>
                        <td class="text-end"> <?php echo number_format($chambre['tarif_chambre'], '0', '', ' ') . ' Ar' ?> </td>
                        <td>
                            <div class="row">
                                <div class="col-1 ms-2 center">
                                    <?php if ($chambre['statut_chambre'] == 'Libre') echo ('<i class="fas fa-tag text-success"></i>') ?>
                                    <?php if ($chambre['statut_chambre'] == 'En attente') echo ('<i class="fas fa-exclamation-triangle text-danger"></i>') ?>
                                    <?php if ($chambre['statut_chambre'] == 'Occupée') echo ('<i class="fas fa-house-user text-secondary"></i>') ?>
                                </div>
                                <div class="col text-start"><?php echo ($chambre['statut_chambre']) ?></div>
                            </div>

                        </td>
                        <?php if (session()->get('isUser') == 'Administrateur') : ?>
                            <td>
                                <div class="center">
                                    <div>
                                        <button type="button" class="btn btn-outline-dark btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalChambreUpdate" onclick="updateChambre('<?php echo $chambre['ID_chambre']; ?>' ,'update')"><i class="fas fa-pencil-alt"></i></button>
                                        <button type="button" class="btn btn-outline-danger btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalChambreDelete" onclick="deleteData('<?php echo $chambre['ID_chambre']; ?>')"><i class="fas fa-trash-alt"></i></button>
                                        <!-- <button type="button" class="btn btn-outline-success btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalChambreInfo" onclick="infoData('<?php echo $chambre['ID_chambre']; ?>')"><img src="assets/icons/info-circle-fill.svg" alt="Info"></button> -->
                                    </div>
                                </div>
                            </td>
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
                        <td colspan="4">Tableau vide.</td>
                    <?php endif; ?>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>



    <script>
        let dataChambre = <?php echo ($jsonChambre) ?>;
        let obj = JSON.stringify(dataChambre);

        function chambreJSON() {
            $(document).ready(function() {
                $.ajax({
                    url: 'saveTarif',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        dataJSON: obj,
                    },

                    success: function(result) {
                        console.log(result);
                    },
                    error: function() {
                        alert('Erreur');
                    },
                })
            });
        }
    </script>



    <!-- <form action="saveTarif" method="post"> -->
    <div class="container-fluid p-0 d-flex justify-content-end">
        <button class="btn btn-primary me-0" onclick="chambreJSON()" name="btn_saveTarif">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-save"></i>
                </div>
                <div class="flex-grow-1 ms-2">
                    Sauvegarder
                </div>
            </div>
        </button>
    </div>
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