<div class="container">
    <div class="container-fluid bg-light formulaire">
        <h1 class="center">NOUVELLE CHAMBRE</h1>
        <form action="" method="post">
            <?php if (session()->get('success')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->get('success') ?>
                </div>
            <?php endif; ?>
            <div class="form-group">
                <label class="form-label" for="">Tarif par nuit</label>
                <input type="number" class="form-control" name="tarif_chambre" id="" min="1" placeholder="ariary">
            </div>
          

            <div class="form-group mt-2">
                <label class="form-label" for="">Statut chambre</label>
                <select class="form-select" name="statut_chambre">
                    <option selected value="Libre">Libre</option>
                    <option value="Occupée">Occupée</option>
                    <option value="En attente">En attente</option>
                </select>
            </div>
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