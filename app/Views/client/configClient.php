<!--DASHBOARD ADMIN-->
<?php include("modal/modalClient.php"); ?>
<?php include("modal/modalNouveau.php"); ?>

<div class="container-fluid mt-3 mb-3">
    <h1>Liste des clients</h1>
</div>
<div class="container-fluid">

    <?php include("search/recherche.php"); ?>
    <?php if (session()->get('success')) : ?>
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
    <?php endif; ?>
    <table class="table table-hover table-striped table-light" id="result">
        <thead>
            <tr>
                <th scope="col">Identification</th>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Téléphone</th>
                <th scope="col">Actions</th>
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
                        <td> <?php echo ($client['telephone_client']); ?> </td>
                        <td>
                            <div class="center">
                                <div>
                                    <button type="button" class="btn btn-outline-warning btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalClientUpdate" onclick="updateClient('<?php echo $client['ID_client']; ?>' , 'update')"><img src="assets/icons/pencil-fill.svg" alt="Modifier"></button>
                                    <button type="button" class="btn btn-outline-danger btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalClientDelete" onclick="deleteData('<?php echo $client['ID_client']; ?>')"><img src="assets/icons/eraser-fill.svg" alt="Supprimer"></button>
                                    <button type="button" class="btn btn-outline-success btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalClientInfo" onclick="infoData('<?php echo $client['ID_client']; ?>')"><img src="assets/icons/info-circle-fill.svg" alt="Info"></button>
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

    <?= $pager->links('paginationResult', 'pagination') ?>

</div>