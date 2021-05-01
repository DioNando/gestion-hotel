<div class="container">
<div id="ficheCardex">

    <h3 class="center"><?php echo ('Cardex ' . $client['nom_client']) . ' ' . $client[('prenom_client')] ?></h3>

    <!-- <div class="row mt-3 mb-5">
        <div class="col-6">INFO HOTEL</div>
        <div class="col-6">CHAMBRE N° :</div>
    </div>

    <h5 class="center">FICHE D'HOTEL</h5> -->

    <p>Nom : <?php echo ($client['nom_client']) ?> </p>
    <p>Prénoms : <?php echo ($client['prenom_client']) ?> </p>
    <p>Date de naissance : <?php echo ($client['date_naissance']) ?> </p>
    <p>Lieu de naissance : <?php echo ($client['lieu_naissance']) ?> </p>
    <p>Père : <?php echo ($client['pere_client']) ?> </p>
    <p>Mère : <?php echo ($client['mere_client']) ?> </p>
    <p>Profession : <?php echo ($client['profession']) ?> </p>
    <p>Domicile habituel : <?php echo ($client['domicile_habituel']) ?> </p>
    <p>Nationalité : <?php echo ($client['nationalite']) ?> </p>
    <p>Pièce d'identité : <?php echo ($client['piece_identite']) ?> </p>
    <p>N° Pièce : <?php echo ($client['num_piece_identite']) ?> </p>
    <p>Date de délivrance : <?php echo ($client['date_delivrance']) ?> </p>
    <p>Lieu de délivrance : <?php echo ($client['lieu_delivrance']) ?> </p>
    <p>Date fin de validité : <?php echo ($client['date_fin_validite']) ?> </p>


    <!-- 
    <div class="row mt-4 mb-5">
        <div class="col-6">Signature du déclarant</div>
        <div class="col-6">
            <p>Toamasina le ..............................</p>
            <p>Vérifié exact par le receptionniste</p>
        </div>
    </div> -->
</div>

<hr>
<!-- <div class="row">
    <div class="col-6">
        <div class="d-grid gap-2">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        </div>
    </div>
    <div class="col-6">
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary" id="btnExport" name="btn_exportation" onclick="genPDF('<?php echo $client['ID_client']; ?>' , '<?php echo $client['nom_client']; ?>')">Exporter</button>
        </div>
    </div>
</div> -->

<div class="container">
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
        <button class="col-4 mx-3 center btn btn-primary" type="submit" class="btn btn-primary" id="btnExport" name="btn_exportation" onclick="genPDF('<?php echo $client['ID_client']; ?>' , '<?php echo $client['nom_client']; ?>')">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-print"></i>
                </div>
                <div class="flex-grow-1 ms-2">
                    Exporter
                </div>
            </div>
        </button>
    </div>
</div>

</div>