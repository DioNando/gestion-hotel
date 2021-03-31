<!--DASHBOARD ADMIN-->

<div class="container-fluid mt-3">
    
    <?php if (session()->get('isUser') == 'Administrateur') : ?>
        <h1>Etat financier</h1>

<!--DASHBOARD USER-->
    <?php else : ?>
        <h1>Etat financier</h1>

    <?php endif ?>

</div>
