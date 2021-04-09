<table class="table table-hover table-striped table-light">
        <thead>
            <tr>
                <th scope="col">Type de réservation</th>
                <th scope="col">Nombre de personne</th>
                <th scope="col">Remarque</th>
                <th scope="col">Date de réservation</th>
                <th scope="col">Utilisateur</th>
                <th scope="col">Dernière modification</th>
                <th scope="col">Utilisateur</th>
            </tr>
        </thead>
        <tbody class="align-middle">
       
                    <tr>
                        <td> <?php echo ($info['type_reservation']); ?> </td>
                        <td> <?php echo ($info['nbr_personne']); ?> </td>
                        <td> <?php echo ($info['remarque_reservation']); ?> </td>
                        <td> <?php echo ($info['date_reservation_nuit']); ?> </td>
                        <td> <?php echo ($info['nom_user']); ?> </td>
                        <td> <?php echo ($info['date_modification_nuit']); ?> </td>
                        <td> <?php echo ($info['nom_user_modif']); ?> </td> <!-- ID_user_modification -->
                    </tr>

        </tbody>
    </table>