<!--DASHBOARD ADMIN-->
<?php include("modal/modalChambre.php"); ?>
<?php include("modal/modalNouveau.php"); ?>
<?php include("assets/toast/myToast.php"); ?>

<div class="container-fluid mt-3 mb-3">
    <!-- <h1>Liste des chambres</h1> -->

    <h1>
        <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
                <i class="fas fa-clipboard-list"></i>
            </div>
            <div class="flex-grow-1 ms-3">
                Liste des chambres
            </div>
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
    <table class="table table-hover table-striped table-light" id="result">
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
                        <td class="text-end"> <?php echo number_format($chambre['tarif_chambre'], '2', ',', ' ') . ' Ar' ?> </td>
                        <td> <?php echo ($chambre['statut_chambre']) ?> </td>
                        <?php if (session()->get('isUser') == 'Administrateur') : ?>
                            <td>
                                <div class="center">
                                    <div>
                                        <button type="button" class="btn btn-outline-warning btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalChambreUpdate" onclick="updateData('<?php echo $chambre['ID_chambre']; ?>' ,'<?php echo $chambre['description_chambre']; ?>' , '<?php echo $chambre['tarif_chambre']; ?>' , '<?php echo $chambre['statut_chambre']; ?>')"><i class="fas fa-pencil-alt"></i></button>
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

    <?= $pager->links('paginationResult', 'pagination') ?>

</div>