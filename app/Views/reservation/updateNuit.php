<form action="#" method="post">
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="ID_nuit" class="form-label">Identification</label>
                <input type="text" class="form-control" value="<?php echo ($info['ID_nuit']) ?>" name="ID_nuit" readonly>
            </div>
        </div>
        <div class="col-12 col-sm-6 mt-2">
            <div class="form-group">
                <label for="debut_sejour" class="form-label">Début du séjour</label>
                <input type="date" class="form-control" id="dateDebutSejour" onchange="calculNuit(document.getElementById('dateDebutSejour').value, document.getElementById('dateFinSejour').value);" value="<?php echo ($info['debut_sejour']) ?>" name="debut_sejour">
            </div>
        </div>
        <div class="col-12 col-sm-6 mt-2">
            <div class="form-group">
                <label for="fin_sejour" class="form-label">Fin du séjour</label>
                <input type="date" class="form-control" id="dateFinSejour" onchange="calculNuit(document.getElementById('dateDebutSejour').value, document.getElementById('dateFinSejour').value);" value="<?php echo ($info['fin_sejour']) ?>" name="fin_sejour">
            </div>
        </div>
        <div class="col-12 mt-2">
            <div class="form-group">
                <label for="nbr_nuit" class="form-label">Nuitée</label>
                <input type="number" class="form-control" id="nbr_nuit" value="<?php echo ($info['nbr_nuit']) ?>" name="nbr_nuit" min="1" readonly>
            </div>
        </div>
        <div class="col-12 mt-2">
            <div class="form-group">
                <label for="nom_user" class="form-label">Fait par :</label>
                <input type="text" class="form-control" id="#" name="nom_user" value="<?= session()->get('nom_user') ?>" readonly>
            </div>
        </div>

        <div class="col-12 col-sm-6 mt-2">
            <div class="form-group">
                <label for="venant_de" class="form-label">Venant de</label>
                <input type="text" class="form-control" value="<?php echo ($info['venant_de']) ?>" name="venant_de">
            </div>
        </div>
        <div class="col-12 col-sm-6 mt-2">
            <div class="form-group">
                <label for="allant_a" class="form-label">Allant à</label>
                <input type="text" class="form-control" value="<?php echo ($info['allant_a']) ?>" name="allant_a">
            </div>
        </div>
        <div class="col-12 mt-4">
            <div class="p-2 border checkChambre">
            <label for="allant_a" class="form-label">Mode de transpoort</label>
                <div class="form-check">
                    <input class="form-check-input checkRadio" value="Avion" type="checkbox" name="mode_transport" id="mode_transport1">
                    <label class="form-check-label align-middle" for="mode_transport1">
                        Avion
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input checkRadio" value="Train" type="checkbox" name="mode_transport" id="mode_transport2">
                    <label class="form-check-label align-middle" for="mode_transport2">
                        Train
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input checkRadio" value="Auto" type="checkbox" name="mode_transport" id="mode_transport3">
                    <label class="form-check-label align-middle" for="mode_transport3">
                        Auto
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input checkRadio" value="Moto" type="checkbox" name="mode_transport" id="mode_transport4">
                    <label class="form-check-label align-middle" for="mode_transport4">
                        Moto
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input checkRadio" value="Bateau" type="checkbox" name="mode_transport" id="mode_transport5">
                    <label class="form-check-label align-middle" for="mode_transport5">
                        Bateau
                    </label>
                </div>
            </div>
        </div>


        <div class="d-grid gap-2 mt-4">
            <button type="submit" class="btn btn-primary" id="btnSubmit" name="btn_modification">Modifier</button>
        </div>
        <div class="d-grid gap-2 mt-3">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
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

<script>
    function calculNuit(dateDebut, dateFin) {
        var diff = {}
        var x = new Date(dateDebut);
        var y = new Date(dateFin);
        tmp = y - x;

        tmp = Math.floor(tmp / 1000); // Nombre de secondes entre les 2 dates
        diff.sec = tmp % 60; // Extraction du nombre de secondes

        tmp = Math.floor((tmp - diff.sec) / 60); // Nombre de minutes (partie entière)
        diff.min = tmp % 60; // Extraction du nombre de minutes

        tmp = Math.floor((tmp - diff.min) / 60); // Nombre d'heures (entières)
        diff.hour = tmp % 24;

        tmp = Math.floor((tmp - diff.hour) / 24);
        diff.day = tmp;

        document.getElementById('nbr_nuit').value = diff.day;
    }
</script>