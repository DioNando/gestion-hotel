<table class="table table-hover table-striped">
        <thead>
            <tr>
                <th scope="col"><i class="fab fa-slack-hash"></i></th>
                <th scope="col" class="text-start">Nom</th>
                <th scope="col" class="text-start">Prénoms</th>
                <th scope="col" class="text-start">Téléphone</th>
            </tr>
        </thead>
        <tbody class="align-middle">
       
                    <tr>
                        <th scope="row"> <?php echo ($info['ID_client']) ?> </th>
                        <td class="text-start"> <?php echo ($info['nom_client']); ?> </td>
                        <td class="text-start"> <?php echo ($info['prenom_client']); ?> </td>
                        <td class="text-start"> <?php echo ($info['telephone_client']); ?> </td>
                    </tr>

        </tbody>
    </table>