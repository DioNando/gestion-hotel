<!-- VERSION 2.0 -->



<div class="container sideNavLogin">
    <div class="container-fluid mt-5">
        <span class="center img-login mb-2"><img src="assets/images/login1.png"></span>
        <h1 class="center text-light">Se connecter</h1>
        <form action="" method="post">
            <div class="form-group mt-3">
                <input type="text" class="form-control" name="nom_user" id="nom_user" autocomplete="off" placeholder="Utilisateur">
            </div>

            <div class="form-group mt-4 mb-4">
                <input type="password" class="form-control" name="mdp_user" id="mdp_user" placeholder="Mot de passe">
            </div>
            <hr>
            <div class="d-grid gap-2 mt-4">
                <button type="submit" class="btn btn-primary" name="btn_connexion">
                    <div class="row">
                        <div class="col text-start">Se connecter</div>
                        <div class="col-1 center"><i class="fas fa-sign-out-alt"></i></div>
                    </div>
                </button>
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


    <div class="fixed-bottom">
        <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
            <defs>
                <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
            </defs>
            <g class="parallax">
                <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.3)" />
                <use xlink:href="#gentle-wave" x="48" y="2" fill="rgba(255,255,255,0.5)" />
                <!-- <use xlink:href="#gentle-wave" x="48" y="2" fill="rgba(255,255,255,0.4)" /> -->
                <!-- <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.6)" /> -->
            </g>
        </svg>
    </div>

</div>