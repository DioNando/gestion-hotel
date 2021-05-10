<form action="#" method="post">
    <div class="row">
        <div class="col-12" style="display: none;">
            <div class="form-group">
                <label for="ID_day" class="form-label">Identification</label>
                <input type="text" id="ID_day" class="form-control" value="<?php echo ($info['ID_day']) ?>" name="ID_day" readonly>
            </div>
        </div>

        
            

        <div class="col-12 col-sm-4 mt-2">
            <div class="form-group">
                <label for="heure_arrive" class="form-label">Heure d'entrée</label>
                <input type="time" class="form-control" id="heure_arrive" onchange="calculHeure(document.getElementById('heure_arrive').value, document.getElementById('heure_depart').value,);" value="<?php echo ($info['heure_arrive']) ?>" <?php if (session()->get('isUser') == 'Utilisateur') echo('readonly') ?> name="heure_arrive" >
            </div>
        </div>
        <div class="col-12 col-sm-4 mt-2">
            <div class="form-group">
                <label for="heure_depart" class="form-label">Heure de sortie</label>
                <input type="time" class="form-control" id="heure_depart" onchange="calculHeure(document.getElementById('heure_arrive').value, document.getElementById('heure_depart').value,);" value="<?php echo ($info['heure_depart']) ?>" <?php if (session()->get('isUser') == 'Utilisateur') echo('readonly') ?> name="heure_depart">
            </div>
        </div>
        <div class="col-12 col-sm-4 mt-2">
            <div class="form-group">
                <label for="duree_day" class="form-label">Durée</label>
                <input type="number" class="form-control" id="duree_day" name="duree_day" value="<?php echo ($info['duree_day']) ?>" min="1" readonly>
            </div>
        </div>
         <div class="col-12 mt-2">
            <div class="form-group">
                <label for="transfert_chambre" class="form-label">Transfert de chambre</label>
                <!-- TRANSFERT CHAMBRE DEBUT -->

                <div class="row">
                    <div class="input-group">
                        <select class="form-select" <?php if (session()->get('isUser') == 'Utilisateur') echo('disabled') ?> name="chambre_avant">
                            <option selected value="1" style="display: none;">Avant</option>
                            <?php foreach ($chambres as $chambre) { ?>
                                <option value="<?php echo($chambre['ID_chambre']) ?>"><?php echo($chambre['ID_chambre']) ?></option>
                            <?php } ?>
                        </select> <span class="input-group-text"><i class="fas fa-angle-double-right"></i></span>
                        <select class="form-select" <?php if (session()->get('isUser') == 'Utilisateur') echo('disabled') ?> name="chambre_apres">
                            <option selected value="2" style="display: none;">Après</option>
                            <?php foreach ($listeChambres as $listeChambre) { ?>
                                <option value="<?php echo($listeChambre['ID_chambre']) ?>"><?php echo($listeChambre['ID_chambre']) ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <!-- TRANSFERT CHAMBRE FIN -->
            </div>
        </div>

        <div class="container">
            <hr>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="commentaire_day" class="form-label">Commentaire</label>
                <textarea class="form-control" id="commentaire_day" name="commentaire_day" rows="2"></textarea>
            </div>
        </div>
        <div class="col-12 mt-2">
            <div class="form-group">
                <label for="nom_user" class="form-label">Fait par :</label>
                <input type="text" class="form-control" id="#" name="nom_user" value="<?= session()->get('nom_user') ?>" readonly>
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
    var today = new Date();
    // var time = today.getHours() + ":" + today.getMinutes();
    // document.getElementById('heure_arrive').value = time;
    // document.getElementById('heure_depart').value = time;

    function calculHeure(heure_arrive, heure_depart) {
        x = heure_arrive.split(':');
        y = heure_depart.split(':');

        let debut, fin, temps;

        debut = x[0] * 60 + parseInt(x[1]);
        fin = y[0] * 60 + parseInt(y[1]);

        temps = (fin - debut) / 60;
        if (temps < 0) {
            fin += 1440;
            temps = (fin - debut) / 60;
        };

        console.log(temps);
        temps = Math.round(temps);

        document.getElementById('duree_day').value = temps;
    }
</script>


