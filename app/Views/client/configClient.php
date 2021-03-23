<!--DASHBOARD ADMIN-->
<?php include("modal/modalClient.php"); ?>

<div class="container-fluid mt-3">
    
    
    <h1>Liste des clients</h1>
    
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
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
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
                        <td>
                            <div class="center">
                                <div>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalClientUpdate" onclick="updateData('<?php echo $client['ID_client']; ?>' , '<?php echo $client['nom_client']; ?>' , '<?php echo $client['prenom_client']; ?>')"><img src="assets/icons/pencil-fill.svg" alt="Modifier"></button>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalClientDelete" onclick="deleteData('<?php echo $client['ID_client']; ?>')"><img src="assets/icons/eraser-fill.svg" alt="Supprimer"></button>
                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalClientInfo" onclick="infoData('<?php echo $client['ID_client']; ?>')"><img src="assets/icons/info-circle-fill.svg" alt="Info"></button>
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
                        <td colspan="4">Tableau vide.</td>
                    <?php else : ?>
                        <td colspan="3">Tableau vide.</td>
                    <?php endif; ?>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>



</div>