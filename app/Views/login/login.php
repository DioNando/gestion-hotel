<div class="container">
    <div class="container-fluid bg-light formulaire formulaire-login">
        <span class="center mb-2"><img src="assets/images/login5.png"></span>
        <h1 class="center">SE CONNECTER</h1>
        <form action="" method="post">
            <div class="form-group"><label for="">Nom</label>
                <input type="text" class="form-control" name="nom_user" id="">
            </div>

            <div class="form-group mt-2">
                <label for="">Mot de passe</label>
                <input type="password" class="form-control" name="mdp_user" id="">
            </div>
            <div class="d-grid gap-2 mt-3">
                <button type="submit" class="btn btn-primary" name="btn_connexion">Connexion</button>
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