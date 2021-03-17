<!--DASHBOARD ADMIN-->
<div class="container">
    <div class="container-fluid">
    
        <?php if (session()->get('isAdmin')) : ?>
            <h1>Dashboard administrateur, <?= session()->get('nom_admin') ?></h1>
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
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal" onclick="updateData('<?php echo $client['ID_client']; ?>' , '<?php echo $client['nom_client']; ?>')"><img src="assets/icons/pencil-fill.svg" alt="Modifier"></button>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal" onclick="deleteData('<?php echo $client['ID_client']; ?>')"><img src="assets/icons/eraser-fill.svg" alt="Supprimer"></button>
                                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modal" onclick="infoData('<?php echo $client['ID_client']; ?>')"><img src="assets/icons/info-circle-fill.svg" alt="Info"></button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="4">No data found.</td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>

            <!--DASHBOARD USER-->
        <?php else : ?>
            <h1>Dashboard, <?= session()->get('nom_user') ?></h1>

        <?php endif ?>

    </div>
</div>