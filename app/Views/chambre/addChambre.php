<div class="container">
    <div class="container-fluid bg-light formulaire">
        <h1 class="center">NOUVELLE CHAMBRE</h1>
        <form action="" method="post">
            <?php if (session()->get('success')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->get('success') ?>
                </div>
            <?php endif; ?>
            <div class="form-group mt-2">
                <label class="form-label" for="num_chambre">Numéro de la chambre</label>
                <input type="text" class="form-control" name="num_chambre" id="num_chambre">
            </div>
            <div class="form-group mt-2">
                <!-- <label class="form-label" for="description_chambre">Description</label>
                <input type="text" class="form-control" name="description_chambre" id="description_chambre"> -->
                <label for="descri_chambre" class="form-label">Description de la chambre</label>
                <textarea class="form-control" id="descri_chambre" name="description_chambre" rows="2"></textarea>
            </div>
            <div class="form-group mt-2">
                <label class="form-label" for="tarif_chambre">Tarif par nuit</label>
                <input type="number" class="form-control" name="tarif_temp" id="tarif_chambre" placeholder="ariary">
            </div>
            <div class="form-group mt-2">
                <label class="form-label" for="">Statut chambre</label>
                <select class="form-select" name="statut_chambre">
                    <option selected value="Libre">Libre</option>
                    <option value="Occupée">Occupée</option>
                    <option value="En attente">En attente</option>
                </select>
            </div>
         
            <!-- <div class="d-grid gap-2 mt-3">
                <button type="submit" class="btn btn-primary" name="btn_enregistrer">Valider</button>
            </div> -->

            <div class="container-fluid mt-3 p-0 d-flex justify-content-end">
                <button class="btn btn-primary me-0" name="btn_enregistrer">
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