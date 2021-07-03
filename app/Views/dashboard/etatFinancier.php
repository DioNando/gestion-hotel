<!--DASHBOARD ADMIN-->

<div class="container-fluid mt-3 mb-3">

    <?php if (session()->get('isUser') == 'Administrateur') : ?>
        <!-- <h1>Etat financier</h1> -->

        <h1>
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-file-invoice-dollar"></i>
                </div>
                <div class="flex-grow-1 ms-3">
                    Etat financier
                </div>
            </div>
        </h1>

        <!--DASHBOARD USER-->
    <?php else : ?>
        <h1>Etat financier</h1>

    <?php endif ?>

</div>


<!-- <div class="container">
    <h5 class="mt-5 mb-5">En cours de développement...</h5>

    <div class="row g-2">
        <div class="col-6">
            <div class="container">
                <div class="row g-2">
                    <div class="col-12">
                        <div class="p-3 border bg-dark">Custom column padding</div>
                    </div>
                    <div class="col-4">
                        <div class="p-3 border bg-dark">Custom column padding</div>
                    </div>
                    <div class="col-4">
                        <div class="p-3 border bg-dark">Custom column padding</div>
                    </div>
                    <div class="col-4">
                        <div class="p-3 border bg-dark">Custom column padding</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="p-3 border bg-dark">Custom column padding</div>
        </div>
        <div class="col-6">
            <div class="container">
                <div class="row g-2">
                    <div class="col-6">
                        <div class="p-3 border bg-dark">Custom column padding</div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 border bg-dark">Custom column padding</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="p-3 border bg-dark">Custom column padding</div>
        </div>
    </div>
</div> -->

<!-- <div class="container"> -->
<!-- <div class="container-fluid">
    <form action="searchEtatFinancier" method="post" class="d-flex row">
        <div class="input-group col">
            <span class="input-group-text">De</span>
            <input type="date" class="form-control" name="date_debut">
        </div>
        <div class="input-group col">
            <span class="input-group-text">A</span>
            <input type="date" class="form-control" name="date_fin">
        </div>
        <button class="btn btn-outline-success border col" type="submit" name="btn_recherche">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-search"></i>
                </div>
                <div class="flex-grow-1 ms-2">
                    Rechercher
                </div>
            </div>
        </button>
    </form>
</div> -->

<div class="container-fluid">
    <nav class="navbar navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand">Période <?php if (isset($debut) and isset($fin)) {
                                                echo (' : ' . $debut . ' à ' . $fin);
                                            } ?></a>
            <form action="searchEtatFinancier" method="post" class="d-flex">
                <div class="input-group me-3">
                    <span class="input-group-text">De</span>
                    <input type="date" class="form-control" name="date_debut">
                </div>
                <div class="input-group me-3">
                    <span class="input-group-text">A</span>
                    <input type="date" class="form-control" name="date_fin">
                </div>
                <button class="btn btn-outline-success border col" type="submit" name="btn_recherche">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-search"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            Rechercher
                        </div>
                    </div>
                </button>
            </form>
        </div>
    </nav>
    <div class="m-3">
        <h2>Total : <?php echo number_format($total, '0', '', ' ') . ' Ar'; ?></h2>
    </div>
</div>

<!-- ICI COMMENCE LE TABLEAU -->

<div class="container-fluid overflow-auto mt-4">
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th scope="col"><i class="fab fa-slack-hash"></i></th>
                <th scope="col" class="text-center">Durée</th>
                <th scope="col" class="text-end">Montant</th>
                <th scope="col" class="text-end">Surplus</th>
                <th scope="col" class="text-center">Offert</th>
                <th scope="col" class="text-end">Remise</th>
                <th scope="col" class="text-end">Total</th>
            </tr>
        </thead>
        <tbody class="align-middle">

            <?php
            if (count($plannings) > 0) {
                foreach ($plannings as $planning) { ?>

                    <tr>
                        <th scope="row">
                            <?php echo ($planning['ID_chambre']); ?>
                        </th>
                        <td class="text-center"><?php echo ($planning['duree']); ?></td>
                        <td class="text-end"><?php echo number_format($planning['montant'], '0', '', ' ') . ' Ar'; ?></td>
                        <td class="text-end"><?php echo number_format($planning['surplus'], '0', '', ' ') . ' Ar'; ?></td>
                        <td class="text-center"><?php if ($planning['offert']) echo ('Oui'); ?></td>
                        <td class="text-end"><?php echo ($planning['remise']) . ' %'; ?></td>
                        <td class="text-end"><?php echo number_format($planning['total'], '0', '', ' ') . ' Ar'; ?></td>

                    <?php
                }
            } else {
                    ?>
                    <tr>
                        <?php if (session()->get('isUser') == 'Administrateur') : ?>
                            <td colspan="7">Tableau vide.</td>
                        <?php else : ?>
                            <td colspan="7">Tableau vide.</td>
                        <?php endif; ?>
                    </tr>
                <?php
            }
                ?>
        </tbody>
    </table>

</div>



























</div>