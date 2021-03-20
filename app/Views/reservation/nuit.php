<div class="container">
    <div class="container-fluid bg-light formulaire">
        <h1 class="center">RESERVATION NUIT</h1>
        <form action="" method="post">
            <div class="row">
            <div class="col-12">
                <?php if (session()->get('success')) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= session()->get('success') ?>
                    </div>
                <?php endif; ?>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="nom_client" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="#" name="nom_client" value="<?= session()->get('nom_client') ?>" readonly>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="prenom_client" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="#" name="prenom_client" value="<?= session()->get('prenom_client') ?>" readonly>
                    </div>
                </div>
                <div class="col-12 mt-2">
                    <div class="form-group">
                        <label for="nbr_personne" class="form-label">Nombre de personne</label>
                        <input type="number" class="form-control" id="#" name="nbr_personne" value="1" min="1">
                    </div>
                </div>
                <div class="col-12 col-sm-6 mt-2">
                    <div class="form-group">
                        <label for="debut_sejour" class="form-label">Début du séjour</label>
                        <input type="date" class="form-control" id="#" name="debut_sejour">
                    </div>
                </div>
                <div class="col-12 col-sm-6 mt-2">
                    <div class="form-group">
                        <label for="fin_sejour" class="form-label">Fin du séjour</label>
                        <input type="date" class="form-control" id="#" name="fin_sejour">
                    </div>
                </div>
                <div class="col-12 mt-2">
                    <div class="form-group">
                        <label for="nom_user" class="form-label">Fait par :</label>
                        <input type="text" class="form-control" id="#" name="nom_user" value="<?= session()->get('nom_user') ?>" readonly>
                    </div>
                </div>
                <div class="d-grid gap-2 mt-3">
                    <button type="submit" class="btn btn-primary" name="btn_reservation">Valider</button>
                </div>
                <?php
                if (isset($validation)) : ?>
                    <div class="col-12 mt-3">
                        <div class="alert alert-danger" role="alert">
                            <?= $validation->listErrors() ?>
                        </div>
                    </div>
                <?php endif ?>
            </div>
        </form>
    </div>
</div>