<div class="container">
    <div class="container-fluid bg-light formulaire">
        <h1 class="center">NOUVEAU CLIENT</h1>
        <form action="" method="post">
            <?php if (session()->get('success')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->get('success') ?>
                </div>
            <?php endif; ?>
            <div class="form-group"><label for="">Nom</label>
                <input type="text" class="form-control" name="nom_client" id="">
            </div>

            <div class="form-group mt-2">
                <label for="">Prénom</label>
                <input type="text" class="form-control" name="prenom_client" id="">
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
        </form>
    </div>
</div>