<!-- VERSION 2.0 -->

<div class="container">
    <div class="container-fluid formulaire formulaire-login">
        <span class="center mb-2"><img src="assets/images/login1.png"></span>
        <h1 class="center">SE CONNECTER</h1>
        <form action="" method="post">
            <div class="form-group mt-3">
                <input type="text" class="form-control" name="nom_user" id="nom_user" autocomplete="off" placeholder="Nom d'utilisateur">
            </div>

            <div class="form-group mt-4 mb-4">
                <input type="password" class="form-control" name="mdp_user" id="mdp_user" placeholder="Mot de passe">
            </div>
            <hr>
            <div class="d-grid gap-2 mt-4">
                <button type="submit" class="btn btn-primary" name="btn_connexion">Connexion</button>
            </div>
            <?php
            if (isset($validation)) : ?>
                <div class="col-12 mt-4">
                    <div class="alert alert-danger" role="alert">
                        <?= $validation->listErrors() ?>
                    </div>
                </div>
            <?php endif ?>
        </form>
    </div>
</div>
