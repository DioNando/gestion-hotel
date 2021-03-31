<!--DASHBOARD ADMIN-->

<div class="container-fluid mt-3">
    
    <?php if (session()->get('isUser') == 'Administrateur') : ?>
        <h1>Statistique</h1>

<!--DASHBOARD USER-->
    <?php else : ?>
        <h1>Statistique</h1>

    <?php endif ?>

</div>
