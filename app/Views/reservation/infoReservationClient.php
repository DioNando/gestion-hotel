<table class="table table-hover table-striped table-light" id="result">
        <thead>
            <tr>
                <th scope="col">Identification</th>
                <th scope="col">Debut séjour</th>
                <th scope="col">Fin séjour</th>
                <th scope="col">Nuitées</th>
                <th scope="col">Détails</th>
                <th scope="col">Info client</th>
                <th scope="col">Info réservation</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody class="align-middle">
       
                    <tr>
                        <th scope="row"> <?php echo ($info['ID_nuit']) ?> </th>
                        <td> <?php echo ($info['debut_sejour']); ?> </td>
                        <td> <?php echo ($info['fin_sejour']); ?> </td>
                        <th> <?php echo ($info['nbr_nuit']); ?> </th>
                        <td>
                            <div class="center">
                                <div>
                                    <button type="button" class="btn btn-outline-primary btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalReservationInfo" onclick="infoData('<?php echo $info['ID_nuit']; ?>')"><img src="assets/icons/info-circle-fill.svg" alt="Info"></button>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="center">
                                <div>
                                    <button type="button" class="btn btn-outline-secondary btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalReservationInfoClient" id="infoClient" onclick="infoClient('<?php echo $info['ID_nuit']; ?>')"><img src="assets/icons/people-fill.svg" alt="Info"></button>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="center">
                                <div>
                                    <button type="button" class="btn btn-outline-success btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalReservationInfo" onclick="infoData('<?php echo $info['ID_nuit']; ?>')"><img src="assets/icons/stickies-fill.svg" alt="Info"></button>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="center">
                                <div>
                                    <button type="button" class="btn btn-outline-warning btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalReservationUpdate" onclick="updateData('<?php echo $info['ID_nuit']; ?>' , '<?php echo $info['ID_client']; ?>' , '<?php echo $info['ID_user']; ?>')"><img src="assets/icons/pencil-fill.svg" alt="Modifier"></button>
                                    <button type="button" class="btn btn-outline-danger btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalReservationDelete" onclick="deleteData('<?php echo $info['ID_nuit']; ?>')"><img src="assets/icons/eraser-fill.svg" alt="Supprimer"></button>
                                </div>
                            </div>
                        </td>
                    </tr>

        </tbody>
    </table>