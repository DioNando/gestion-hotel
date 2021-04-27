<!--DASHBOARD ADMIN-->
<?php include("modal/modalClient.php"); ?>
<?php include("assets/toast/myToast.php"); ?>

<div class="container-fluid mt-3 mb-3">
    <!-- <h1>Fiche Cardex</h1> -->

    <h1>
        <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
                <i class="far fa-id-card"></i>
            </div>
            <div class="flex-grow-1 ms-3">
                Fiche Cardex
            </div>
        </div>
    </h1>
</div>
<div class="container-fluid">

    <?php include("search/recherche.php"); ?>
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
    <table class="table table-hover table-striped table-light">
        <thead>
            <tr>
                <th scope="col"><i class="fab fa-slack-hash"></i></th>
                <th scope="col" class="text-start">Nom</th>
                <th scope="col" class="text-start">Prénom</th>
                <th scope="col">Historique</th>
                <th scope="col">Modifier</th>
                <th scope="col">Fiche Cardex</th>
            </tr>
        </thead>
        <tbody class="align-middle">
            <?php
            if (count($clients) > 0) {

                foreach ($clients as $client) {

            ?>
                    <tr>
                        <th scope="row"> <?php echo ($client['ID_client']) ?> </th>
                        <td> <?php echo ($client['nom_client']); ?> </td>
                        <td> <?php echo ($client['prenom_client']); ?> </td>
                        <td>
                            <div class="center">
                                <div>
                                    <button type="button" class="btn btn-outline-secondary btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalInfoHistorique" onclick="infoHistorique('<?php echo $client['ID_client']; ?>' , 'historique')"><i class="fas fa-history"></i></button>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="center">
                                <div>
                                    <button type="button" class="btn btn-outline-warning btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalCardexUpdate" onclick="updateCardex('<?php echo $client['ID_client']; ?>' , 'update')"><i class="fas fa-pencil-alt"></i></button>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="center">
                                <div>
                                    <button type="button" class="btn btn-outline-success btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalFicheCardex" onclick="infoFicheCardex('<?php echo $client['ID_client']; ?>', 'cardex')"><i class="far fa-id-card"></i></button>
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

    <?= $pager->links('paginationResult', 'pagination') ?>

</div>