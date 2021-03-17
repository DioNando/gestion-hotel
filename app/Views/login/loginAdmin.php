<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="navbar-collapse">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link" href="index.php">Connexion client</a></li>
        </ul>
        <ul class="navbar-nav my-2 my-lg-0">
            <li class="nav-item"><a class="nav-link" href="loginAdmin">Connexion admin</a></li>
        </ul>
    </div>
</nav>


<div class="container">
    <div class="container-fluid bg-light formulaire">
        <h1 class="center">LOGIN ADMIN</h1>
        <form action="" method="post">
            <div class="form-group"><label for="">Nom</label>
                <input type="text" class="form-control" name="nom_admin" id="">
            </div>

            <div class="form-group mt-2">
                <label for="">Mot de passe</label>
                <input type="password" class="form-control" name="mdp_admin" id="">
            </div>
            <div class="d-grid gap-2 mt-3">
            <button type="submit" class="btn btn-primary" name="btn_connexion">Connexion</button>
            </div>
        </form>
    </div>
</div>