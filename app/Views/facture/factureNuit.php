<div class="container">
    <div class="container-fluid bg-light formulaire">
        <h1 class="center">FACTURATION NUITEE</h1>
        <form action="" method="post">
            <div class="row">
                <div class="col-12">
                    <?php if (session()->get('success')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->get('success') ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col">
                            <h5 class="mt-3 mb-3">De</h5>

                            <div class="mb-1 row">
                                <label for="#" class="col-sm-2 col-form-label">Nom</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="#" value="Hotel" readonly>
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <label for="#" class="col-sm-2 col-form-label">Adresse</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="#" value="rue 02 Toamasina" readonly>
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <label for="#" class="col-sm-2 col-form-label">Mail</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="#" value="hotel@mail.mg" readonly>
                                </div>
                            </div>
                            <div class="mb-1 row">
                                <label for="#" class="col-sm-2 col-form-label">Téléphone</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="#" value="+261 34 00 000 01" readonly>
                                </div>
                            </div>
                            <div class="mb-1 row">
                                <label for="#" class="col-sm-2 col-form-label">Par</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="#" value="<?= session()->get('nom_user') ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <h5 class="mt-3 mb-3">Adresse de facturation</h5>

                            <div class="mb-1 row">
                                <label for="#" class="col-sm-2 col-form-label">Nom</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="#" value="<?= session()->get('nom_client') ?>" readonly>
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <label for="#" class="col-sm-2 col-form-label">Prénom</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="#" value="<?= session()->get('prenom_client') ?>" readonly>
                                </div>
                            </div>

                            <div class="mb-1 row">
                                <label for="#" class="col-sm-2 col-form-label">Téléphone</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="#" value="<?= session()->get('telephone_client') ?>" readonly>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>


                <div class="col-12 col-sm-6 mt-2 mb-2 text-center">
                    <div class="form-group">
                        <label for="debut_sejour" class="form-label">Date de facturation</label>
                        <input type="date" class="form-control" id="dateDebutSejour" onchange="calculNuit(document.getElementById('dateDebutSejour').value, document.getElementById('dateFinSejour').value);" name="debut_sejour">
                    </div>
                </div>
                <div class="col-12 col-sm-6 mt-2 mb-2 text-center">
                    <div class="form-group">
                        <label class="form-label" for="">Type de payement</label>
                        <select class="form-select" name="type_reservation">
                            <option selected value="espece">Espèce</option>
                            <option value="telma">MVola</option>
                            <option value="orange">Orange Money</option>
                            <option value="airtel">Airtel Money</option>
                            <option value="visa">VISA</option>
                        </select>
                    </div>
                </div>

                <?php
                $total = 0;
                foreach ($details as $detail) {
                    $total = $total + ($detail['tarif_chambre'] * $detail['nbr_nuit']);
                }
                $montant = $total;
                $reste = $total - $montant;
                ?>

                <table class="table mt-2">
                    <thead>
                        <tr>
                            <th scope="col">N°Chambre</th>
                            <th scope="col">Prix Unitaire</th>
                            <th scope="col">Nuitée</th>
                            <th scope="col">Lit supplémentaire</th>
                            <th scope="col">Montant</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($details as $detail) { ?>
                            <tr>
                                <th> <?php echo ($detail['ID_chambre']) ?> </th>
                                <td> <?php echo number_format($detail['tarif_chambre'], 2, ',', ' ')  . ' Ar' ?> </td>
                                <td scope="row"> <?php echo ($detail['nbr_nuit']) ?> </td>
                                <td> <?php echo ('0'); ?> </td>
                                <td> <?php echo number_format($detail['tarif_chambre'] * $detail['nbr_nuit'], 2, ',', ' ') . ' Ar' ?> </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <hr class="mt-4">

                <table>

                    <tr>
                        <td class="text-end">Sous-total</td>
                        <td class="text-center"><?php echo number_format($total, 2, ',', ' ') . ' Ar' ?></td>
                    </tr>
                    <tr>
                        <td class="text-end">Remise (<?php echo session()->get('remise') ?>")</td>
                        <td class="text-center"> <?php echo number_format(0, 2, ',', ' ') . ' Ar' ?> </td>
                    </tr>
                    <tr>
                        <td class="text-end">Total</td>
                        <td class="text-center"><b> <?php echo number_format($total, 2, ',', ' ') . ' Ar' ?> </b></td>
                    </tr>
                    <tr>
                        <td class="text-end">Solde Dû</td>
                        <td class="text-center"><b> <?php echo number_format($reste, 2, ',', ' ') . ' Ar' ?> </b></td>
                    </tr>
                </table>


                <div class="col-12 col-sm-6">
                    <div class="d-grid gap-2 mt-3">
                        <button type="submit" class="btn btn-primary" name="btn_attente">En attente</button>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="d-grid gap-2 mt-3">
                        <button type="submit" class="btn btn-secondary" name="btn_imprimer">Imprimer</button>
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
    </div>
</div>

<script>
    var dateDebut = new Date();
    document.getElementById('dateDebutSejour').valueAsDate = dateDebut;
    document.getElementById('dateFinSejour').valueAsDate = dateDebut;

    function calculNuit(dateDebut, dateFin) {
        var diff = {}
        var x = new Date(dateDebut);
        var y = new Date(dateFin);
        tmp = y - x;

        tmp = Math.floor(tmp / 1000); // Nombre de secondes entre les 2 dates
        diff.sec = tmp % 60; // Extraction du nombre de secondes

        tmp = Math.floor((tmp - diff.sec) / 60); // Nombre de minutes (partie entière)
        diff.min = tmp % 60; // Extraction du nombre de minutes

        tmp = Math.floor((tmp - diff.min) / 60); // Nombre d'heures (entières)
        diff.hour = tmp % 24;

        tmp = Math.floor((tmp - diff.hour) / 24);
        diff.day = tmp;

        document.getElementById('nbr_nuit').value = diff.day;
    }
</script>