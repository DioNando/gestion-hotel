<div class="container">
    <div class="container-fluid bg-light formulaire">
        <h1 class="center">PROFIL UTILISATEUR</h1>
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
                        <label for="nom_user" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom_user" name="nom_user" value="<?php echo($user['nom_user']) ?>" readonly>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="prenom_user" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="prenom_user" name="prenom_user" value="<?php echo($user['prenom_user']) ?>" readonly>
                    </div>
                </div>
                <div class="col-12 mt-2">
                    <div class="form-group">
                        <label for="droit_user" class="form-label">Droit</label>
                        <input type="text" class="form-control" id="droit_user" name="droit_user" value="<?php echo($user['droit_user']) ?>" readonly>
                    </div>
                </div>
                <!-- <div class="col-12 col-sm-6 mt-2">
                    <div class="form-group">
                        <label for="mdp_user" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="mdp_user" name="mdp_user">
                    </div>
                </div>
                <div class="col-12 col-sm-6 mt-2">
                    <div class="form-group">
                        <label for="mdp_user_confirm" class="form-label">Confirmer mot de passe</label>
                        <input type="password" class="form-control" id="mdp_user_confirm" name="mdp_user_confirm">
                    </div>
                </div> -->
                <div class="col-12 col-sm-12">
                    <div class="d-grid gap-2 mt-3">
                        <button type="submit" class="btn btn-primary" name="btn_modification_profil">Modification</button>
                    </div>
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