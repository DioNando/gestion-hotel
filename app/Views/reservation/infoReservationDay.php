<table class="table table-hover table-striped table-light">
        <thead>
            <tr>
                <th scope="col">Date de réservation</th>
                <th scope="col">Utilisateur</th>
                <th scope="col">Dernière modification</th>
                <th scope="col">Utilisateur</th>
            </tr>
        </thead>
        <tbody class="align-middle">
       
                    <tr>                    
                        <td> <?php echo ($info['date_reservation_day']); ?> </td>
                        <td> <?php echo ($info['nom_user']); ?> </td>
                        <td> <?php echo ($info['date_modification_day']); ?> </td>
                        <td> <?php echo ($info['nom_user_modif']); ?> </td> <!-- ID_user_modification -->
                    </tr>

        </tbody>
    </table>