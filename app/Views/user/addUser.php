<div class="container">
    <div class="container-fluid bg-light formulaire">
        <h1 class="center">NOUVEL UTILISATEUR</h1>
        <form action="" method="post">
            <?php if (session()->get('success')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->get('success') ?>
                </div>
            <?php endif; ?>
            <div class="form-group">
                <label class="form-label" for="nom_user">Nom</label>
                <input type="text" class="form-control" name="nom_user" id="nom_user">
            </div>
            <div class="form-group">
                <label class="form-label" for="prenom_user">Prenom</label>
                <input type="text" class="form-control" name="prenom_user" id="prenom_user">
            </div>

            <div class="form-group mt-2">
                <label class="form-label" for="mdp_user">Mot de passe</label>
                <input type="password" class="form-control" name="mdp_user" id="mdp_user">
            </div>
            <div class="form-group mt-2">
                <label class="form-label" for="droit_user">Droit d'accès</label>
                <select class="form-select" name="droit_user" id="droit_user">
                    <option selected value="Utilisateur">Utilisateur</option>
                    <option value="Controleur">Contrôleur</option>
                    <option value="Administrateur">Administrateur</option>
                </select>
            </div>
            <hr>
            <div class="d-grid gap-2 mt-3">
                <button type="submit" class="btn btn-primary" name="btn_enregistrer">Valider</button>
            </div>
            <?php
            if (isset($validation)) : ?>
                <div class="col-12 mt-3">
                    <div class="alert alert-danger" role="alert">
                        <?= $validation->listErrors() ?>
                    </div>
                </div>
            <?php endif ?>
        </form>
    </div>
</div>