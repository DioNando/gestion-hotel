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

        <div class="col-12 col-lg-6 mt-2">
            <label for="" class="form-label">Le client est-il arrivé ?</label>
            <div class="p-2 border checkChambre">

                <div class="form-check">
                    <input class="form-check-input checkRadio" type="radio" name="etat_client" id="etat_client_0" value="0" <?php if($info['etat_client'] == 0) echo ('checked') ?>>
                    <label class="form-check-label align-middle" for="etat_client_0">
                        Non
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input checkRadio" type="radio" name="etat_client" value="1" id="etat_client_1" <?php if($info['etat_client'] == 1) echo ('checked') ?>>
                    <label class="form-check-label align-middle" for="etat_client_1">
                        Oui
                    </label>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 mt-2">
            <label for="" class="form-label">Confirmation de la reservation ?</label>

            <div class="p-2 border checkChambre">

                <div class="form-check">
                    <input class="form-check-input checkRadio" type="radio" name="confirmation_reservation" value="0" id="confirmation_reservation_0" <?php if($info['confirmation_reservation'] == 0) echo ('checked') ?>>
                    <label class="form-check-label align-middle" for="confirmation_reservation_0">
                        En attente
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input checkRadio" type="radio" name="confirmation_reservation" value="1" id="confirmation_reservation_1" <?php if($info['confirmation_reservation'] == 1) echo ('checked') ?>>
                    <label class="form-check-label align-middle" for="confirmation_reservation_1">
                        Fait
                    </label>
                </div>
            </div>
        </div>



        <div class="col-12 mt-2">
            <div class="form-group">
                <label for="commentaire_nuit" class="form-label">Commentaire</label>
                <textarea class="form-control" id="commentaire_nuit" name="commentaire_nuit" rows="2"><?php echo ($info['commentaire_nuit']) ?></textarea>
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
                <label for="allant_a" class="form-label">Mode de transport</label>
                <div class="form-check">
                    <input class="form-check-input checkRadio" value="Avion" type="radio" name="mode_transport" id="mode_transport1" <?php if($info['mode_transport'] == 'Avion') echo('checked') ?> >
                    <label class="form-check-label align-middle" for="mode_transport1">
                        Avion
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input checkRadio" value="Train" type="radio" name="mode_transport" id="mode_transport2" <?php if($info['mode_transport'] == 'Train') echo('checked') ?> >
                    <label class="form-check-label align-middle" for="mode_transport2">
                        Train
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input checkRadio" value="Auto" type="radio" name="mode_transport" id="mode_transport3" <?php if($info['mode_transport'] == 'Auto') echo('checked') ?> >
                    <label class="form-check-label align-middle" for="mode_transport3">
                        Auto
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input checkRadio" value="Moto" type="radio" name="mode_transport" id="mode_transport4" <?php if($info['mode_transport'] == 'Moto') echo('checked') ?> >
                    <label class="form-check-label align-middle" for="mode_transport4">
                        Moto
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input checkRadio" value="Bateau" type="radio" name="mode_transport" id="mode_transport5" <?php if($info['mode_transport'] == 'Bateau') echo('checked') ?> >
                    <label class="form-check-label align-middle" for="mode_transport5">
                        Bateau
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input checkRadio" value="Autre" type="radio" name="mode_transport" id="mode_transport6" <?php if($info['mode_transport'] == '' || $info['mode_transport'] == 'Autre') echo('checked') ?> >
                    <label class="form-check-label align-middle" for="mode_transport6">
                        Autre
                    </label>
                </div>
            </div>
        </div>


        <!-- <div class="d-grid gap-2 mt-4">
            <button type="submit" class="btn btn-primary" id="btnSubmit" name="btn_modification">Modifier</button>
        </div>
        <div class="d-grid gap-2 mt-3">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        </div> -->

        <div class="container">
            <hr class="my-3">
            <div class="row center mx-2">
                <button class="col-4 mx-3 center btn btn-secondary" type="button" data-bs-dismiss="modal">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-times"></i>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            Annuler
                        </div>
                    </div>
                </button>
                <button class="col-4 mx-3 center btn btn-primary" type="submit" id="btnSubmit" name="btn_modification">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            Modifier
                        </div>
                    </div>
                </button>
            </div>
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