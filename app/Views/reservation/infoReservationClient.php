<table class="table table-hover table-striped table-light">
        <thead>
            <tr>
                <th scope="col">Identification</th>
                <th scope="col">Nom</th>
                <th scope="col">Prénoms</th>
                <th scope="col">Téléphone</th>
            </tr>
        </thead>
        <tbody class="align-middle">
       
                    <tr>
                        <th scope="row"> <?php echo ($info['ID_client']) ?> </th>
                        <td> <?php echo ($info['nom_client']); ?> </td>
                        <td> <?php echo ($info['prenom_client']); ?> </td>
                        <td> <?php echo ($info['telephone_client']); ?> </td>
                    </tr>

        </tbody>
    </table>