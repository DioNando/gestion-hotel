<!--DASHBOARD ADMIN-->
<?php include("modal/modalUser.php"); ?>

<div class="container-fluid mt-3">


    <h1>Liste des utilisateurs</h1>
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
                <th scope="col">Droit</th>
                <?php if (session()->get('isUser') == 'Administrateur') : ?>
                    <th scope="col">Actions</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody class="align-middle">
            <?php
            if (count($users) > 0) {

                foreach ($users as $user) {

            ?>
                    <tr>
                        <th scope="row"> <?php echo ($user['ID_user']) ?> </th>
                        <td> <?php echo ($user['nom_user']); ?> </td>
                        <td> <?php echo ($user['prenom_user']); ?> </td>
                        <td> <?php echo ($user['droit_user']); ?> </td>
                        <?php if (session()->get('isUser') == 'Administrateur') : ?>
                            <td>
                                <div class="center">
                                    <div>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalUserUpdate" onclick="updateData('<?php echo $user['ID_user']; ?>' , '<?php echo $user['nom_user']; ?>' , '<?php echo $user['prenom_user']; ?>')"><img src="assets/icons/pencil-fill.svg" alt="Modifier"></button>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalUserDelete" onclick="deleteData('<?php echo $user['ID_user']; ?>')"><img src="assets/icons/eraser-fill.svg" alt="Supprimer"></button>
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalUserInfo" onclick="infoData('<?php echo $user['ID_user']; ?>')"><img src="assets/icons/info-circle-fill.svg" alt="Info"></button>
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