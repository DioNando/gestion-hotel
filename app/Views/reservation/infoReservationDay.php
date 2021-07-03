<table class="table table-hover table-striped">
        <thead>
            <tr>
                <th scope="col" class="text-start">Date de création</th>
                <!-- <th scope="col">Utilisateur</th> -->
                <th scope="col" class="text-start">Dernière modification</th>
                <!-- <th scope="col">Utilisateur</th> -->
            </tr>
        </thead>
        <tbody class="align-middle">
       
                    <tr>                    
                        <td class="text-start"> <?php echo ($info['date_reservation_day'] . ' par ' . $info['nom_user']); ?> </td>
                        <!-- <td> <?php echo ($info['nom_user']); ?> </td> -->
                        <td class="text-start"> <?php echo ($info['date_modif'] . ' par ' . $info['nom_user_modif']); ?> </td>
                        <!-- <td> <?php echo ($info['nom_user_modif']); ?> </td> -->
                    </tr>

        </tbody>
    </table>