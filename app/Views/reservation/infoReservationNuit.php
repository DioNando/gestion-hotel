<table class="table table-hover table-striped table-light">
    <thead>
        <tr>
            <th scope="col">Type de réservation</th>
            <th scope="col">Nombre de personne</th>
            <th scope="col">Remarque</th>
            <th scope="col">Date de réservation</th>
            <!-- <th scope="col">Utilisateur</th> -->
            <th scope="col">Dernière modification</th>
            <!-- <th scope="col">Utilisateur</th> -->
        </tr>
    </thead>
    <tbody class="align-middle">

        <tr>
            <td> <?php echo ($info['type_reservation']); ?> </td>
            <td> <?php echo ($info['nbr_personne']); ?> </td>
            <td> <?php echo ($info['remarque_reservation']); ?> </td>
            <td> <?php echo ($info['date_reservation_nuit'] . ' par ' . $info['nom_user']); ?> </td>
            <!-- <td> <?php echo ($info['nom_user']); ?> </td> -->
            <td> <?php echo ($info['date_modification_nuit']. ' par ' . $info['nom_user_modif']); ?> </td>
            <!-- <td> <?php echo ($info['nom_user_modif']); ?> </td> -->
        </tr>

    </tbody>
</table>


<div class="accordion" id="accordionExample">
    <div class="accordion-item">
        <h5 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Fiche d'hôtel
            </button>
        </h5>
        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="accordion-body">



                <div id="ficheCardex">

                    <h3 class="center">REPOBLIKAN'I MADAGASIKARA</h3>

                    <div class="row mt-3 mb-5">
                        <div class="col-6">INFO HOTEL</div>
                        <div class="col-6">CHAMBRE N° : <?php foreach ($chambres as $row) {
                                                            echo ($row['ID_chambre']) . ' ';
                                                        } ?></div>
                    </div>





                    <h5 class="center">FICHE D'HOTEL</h5>

                    <p>Nom : <?php echo ($info['nom_client']) ?> </p>
                    <p>Prénoms : <?php echo ($info['prenom_client']) ?> </p>
                    <p>Date de naissance : <?php echo ($info['date_naissance']) ?> </p>
                    <p>Lieu de naissance : <?php echo ($info['lieu_naissance']) ?> </p>
                    <p>Père : <?php echo ($info['pere_client']) ?> </p>
                    <p>Mère : <?php echo ($info['mere_client']) ?> </p>
                    <p>Profession : <?php echo ($info['profession']) ?> </p>
                    <p>Domicile habituel : <?php echo ($info['domicile_habituel']) ?> </p>
                    <p>Nationalité : <?php echo ($info['nationalite']) ?> </p>
                    <p>Pièce d'identité : <?php echo ($info['piece_identite']) ?> </p>
                    <p>N° Pièce : <?php echo ($info['num_piece_identite']) ?> </p>
                    <p>Date de délivrance : <?php echo ($info['date_delivrance']) ?> </p>
                    <p>Lieu de délivrance : <?php echo ($info['lieu_delivrance']) ?> </p>
                    <p>Date fin de validité : <?php echo ($info['date_fin_validite']) ?> </p>
                    <p>Venant de : <?php echo ($info['venant_de']) ?> </p>
                    <p>Allant à : <?php echo ($info['allant_a']) ?> </p>
                    <p>Mode de transport : Avion Train Auto Moto Bateau </p>


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

                <div class="row">
                    <div class="col-6">
                        <div class="d-grid gap-2">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary" id="btnExport" name="btn_exportation" onclick="genPDF('<?php echo $info['ID_client']; ?>' , '<?php echo $info['nom_client']; ?>')">Exporter</button>
                        </div>
                    </div>
                </div>





            </div>
        </div>
    </div>
</div>