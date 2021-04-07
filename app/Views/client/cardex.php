<div id="ficheCardex">

    <h3 class="center">REPOBLIKAN'I MADAGASIKARA</h3>

    <div class="row mt-3 mb-5">
        <div class="col-6">INFO HOTEL</div>
        <div class="col-6">CHAMBRE N° :</div>
    </div>

    <h5 class="center">FICHE D'HOTEL</h5>

    <p>Nom :</p>
    <p>Prénoms :</p>
    <p>Date de naissance :</p>
    <p>Lieu de naissance :</p>
    <p>Père :</p>
    <p>Mère :</p>
    <p>Profession :</p>
    <p>Domicile habituel :</p>
    <p>Nationalité :</p>
    <p>Pièce d'identité :</p>
    <p>N° Pièce :</p>
    <p>Date de délivrance :</p>
    <p>Lieu de délivrance :</p>
    <p>Date fin de validité :</p>
    <p>Venant de :</p>
    <p>Allant à :</p>
    <p>Mode de transport : Avion Train Auto Moto Bateau
        <!-- <ul>
    <li>Avion</li>
    <li>Train</li>
    <li>Auto</li>
    <li>Moto</li>
    <li>Bateau</li>
</ul> -->
    </p>


    <div class="row mt-4 mb-5">
        <div class="col-6">Signature du déclarant</div>
        <div class="col-6">
            <p>Toamasina le ..............................</p>
            <p>Vérifié exact par le receptionniste</p>
        </div>
    </div>
</div>

<hr>
<!-- <div class="center">
    <button class="btn btn-outline-secondary" type="submit">Exporter</button>
</div> -->

<div class="d-grid gap-2 mt-4">
    <button type="submit" class="btn btn-primary" id="btnExport" name="btn_exportation" onclick="genPDF('<?php echo $client['ID_client']; ?>' , '<?php echo $client['nom_client']; ?>')">Exporter</button>
</div>

<div class="d-grid gap-2 mt-3">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
</div>