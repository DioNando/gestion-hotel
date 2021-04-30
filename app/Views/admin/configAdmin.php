<!--DASHBOARD ADMIN-->
<?php include("modal/modalUser.php"); ?>

<div class="container-fluid mt-3 mb-3">
    <h1>Liste des administrateurs</h1>
</div>
<div class="container-fluid">
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
    <table class="table table-hover table-striped" id="result">
        <thead>
            <tr>
                <th scope="col"><i class="fab fa-slack-hash"></i></th>
                <th scope="col" class="text-start">Nom</th>
                <th scope="col" class="text-start">Prénom</th>
                <?php if (session()->get('isAdmin')) : ?>
                    <th scope="col">Actions</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody class="align-middle">
            <?php
            if (count($admins) > 0) {

                foreach ($admins as $admin) {

            ?>
                    <tr>
                        <th scope="row"> <?php echo ($admin['ID_user']) ?> </th>
                        <td class="text-start"> <?php echo ($admin['nom_user']); ?> </td>
                        <td class="text-start"> <?php echo ($admin['prenom_user']); ?> </td>
                        <?php if (session()->get('isAdmin') == 'Administrateur') : ?>
                            <td>
                                <div class="center">
                                    <div>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalUserUpdate" onclick="updateData('<?php echo $admin['ID_user']; ?>' , '<?php echo $admin['nom_user']; ?>')"><img src="assets/icons/pencil-fill.svg" alt="Modifier"></button>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalUserDelete" onclick="deleteData('<?php echo $admin['ID_user']; ?>')"><img src="assets/icons/eraser-fill.svg" alt="Supprimer"></button>
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalUserInfo" onclick="infoData('<?php echo $admin['ID_user']; ?>')"><img src="assets/icons/info-circle-fill.svg" alt="Info"></button>
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