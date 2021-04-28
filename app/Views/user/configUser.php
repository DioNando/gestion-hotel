<!--DASHBOARD ADMIN-->
<?php include("modal/modalUser.php"); ?>
<?php include("modal/modalNouveau.php"); ?>
<?php include("assets/toast/myToast.php"); ?>

<div class="container-fluid mt-3 mb-3 row">
    <!-- <h1>Liste des utilisateurs</h1> -->

    <h1 class="col">
        <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
                <i class="fas fa-users-cog"></i>
            </div>
            <div class="flex-grow-1 ms-3">
                Liste des utilisateurs
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
    <table class="table table-hover table-striped table-light" id="result">
        <thead>
            <tr>
                <th scope="col"><i class="fab fa-slack-hash"></i></th>
                <th scope="col" class="text-start">Nom</th>
                <th scope="col" class="text-start">Prénom</th>
                <th scope="col" class="text-start">Droit d'accès</th>
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
                        <td> 
                            <div class="row">
                                <div class="col-1 ms-2 center">
                                    <?php if ($user['droit_user'] == 'Administrateur') echo ('<i class="fas fa-user-cog text-primary"></i>') ?>
                                    <?php if ($user['droit_user'] == 'Contrôleur') echo ('<i class="fas fa-users-cog text-secondary"></i>') ?>
                                    <?php if ($user['droit_user'] == 'Utilisateur') echo ('<i class="fas fa-user-friends text-dark"></i>') ?>
                                </div>
                                <div class="col text-start"><?php echo ($user['droit_user']); ?></div>
                            </div>

                        </td>
                        <?php if (session()->get('isUser') == 'Administrateur') : ?>
                            <td>
                                <div class="center">
                                    <div>
                                        <button type="button" class="btn btn-outline-warning btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalUserUpdate" onclick="updateUser('<?php echo $user['ID_user']; ?>' , 'update')"><i class="fas fa-pencil-alt"></i></button>
                                        <button type="button" class="btn btn-outline-danger btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalUserDelete" onclick="deleteData('<?php echo $user['ID_user']; ?>')"><i class="fas fa-trash-alt"></i></button>
                                        <!-- <button type="button" class="btn btn-outline-success btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalUserInfo" onclick="infoData('<?php echo $user['ID_user']; ?>')"><i class="fas fa-info"></i></button> -->
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

    <div class="row mb-4">
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
                    <i class="fas fa-user-cog text-primary"></i>
                </div>
                <div class="flex-grow-1 ms-2">
                    <?php echo ('Administrateur : ' . $administrateur) ?> </div>
            </div>
        </div>
        <div class="col-auto center">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-users-cog text-secondary"></i>
                </div>
                <div class="flex-grow-1 ms-2">
                    <?php echo ('Contrôleur : ' . $controleur) ?> </div>
            </div>
        </div>
        <div class="col-auto center">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-user-friends text-dark"></i>
                </div>
                <div class="flex-grow-1 ms-2">
                    <?php echo ('Utilisateur : ' . $utilisateur) ?> </div>
            </div>
        </div>
    </div>


</div>