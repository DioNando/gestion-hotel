<!--DASHBOARD ADMIN-->

    <div class="container-fluid mt-3">
    
        <?php if (session()->get('isUser') == 'Administrateur') : ?>
            <h1>Dashboard administrateur, <?= session()->get('nom_user') ?></h1>

<!--DASHBOARD USER-->
        <?php else : ?>
            <h1>Dashboard, <?= session()->get('nom_user') ?></h1>

        <?php endif ?>

    </div>
