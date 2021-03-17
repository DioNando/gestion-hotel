<?php if (session()->get('isAdmin')) : ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="dashboard">Tableau de bord</a></li>
                <li class="nav-item"><a class="nav-link" href="register">Réservation</a></li>
            </ul>
            <ul class="navbar-nav my-2 my-lg-0">
                <li class="nav-item"><a class="nav-link" href="logout">Déconnexion</a></li>
            </ul>
        </div>
    </nav>
    <h1>Dashboard administrateur, <?= session()->get('nom_admin') ?></h1>

<?php else : ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="dashboard">Accueil</a></li>
            </ul>
            <ul class="navbar-nav my-2 my-lg-0">
                <li class="nav-item"><a class="nav-link" href="logout">Déconnexion</a></li>
            </ul>
        </div>
    </nav>
    <h1>Dashboard, <?= session()->get('nom_client') ?></h1>
<?php endif ?>

<!--DASHBOARD ADMIN-->
<div class="container">
    <div class="container-fluid">

        <?php if (session()->get('isAdmin')) : ?>
            <table class="table table-hover table-striped table-light" id="result">
                <thead>
                    <tr>
                        <th scope="col">Identification</th>
                        <th scope="col">Nom</th>
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
                            <td colspan="3">No data found.</td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>

            <!--DASHBOARD USER-->
        <?php else : ?>

        <?php endif ?>

    </div>
</div>