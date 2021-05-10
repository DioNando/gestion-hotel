<div class="container">
    <div class="container-fluid bg-light formulaire">
        <h1 class="center">NOUVEAU CLIENT</h1>
        <form action="" method="post">
            <?php if (session()->get('success')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->get('success') ?>
                </div>
            <?php endif; ?>
            <div class="form-group"><label class="form-label" for="nom_client">Nom</label>
                <input type="text" class="form-control" name="nom_client" id="nom_client">
            </div>
            <div class="form-group mt-2">
                <label class="form-label" for="prenom_client">Prénom</label>
                <input type="text" class="form-control" name="prenom_client" id="prenom_client">
            </div>
            <div class="form-group mt-2">
                <label class="form-label" for="telephone_client">Téléphone</label>
                <input type="tel" class="form-control" name="telephone_client" id="telephone_client">
            </div>
            
            <!-- <div class="d-grid gap-2 mt-3">
                <button type="submit" class="btn btn-primary" name="btn_validation">Valider</button>
            </div> -->

            <div class="container-fluid p-0 d-flex mt-3 justify-content-end">
                <button class="btn btn-primary me-0" onclick="chambreJSON()" name="btn_validation">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-save"></i>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            Enregistrer
                        </div>
                    </div>
                </button>
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