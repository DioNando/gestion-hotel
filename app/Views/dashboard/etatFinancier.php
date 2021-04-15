<!--DASHBOARD ADMIN-->

<div class="container-fluid mt-3 mb-3">

    <?php if (session()->get('isUser') == 'Administrateur') : ?>
        <h1>Etat financier</h1>

        <!--DASHBOARD USER-->
    <?php else : ?>
        <h1>Etat financier</h1>

    <?php endif ?>

</div>



<div class="container">
    <div class="row g-2">
        <div class="col-6">
            <div class="container">
                <div class="row g-2">
                    <div class="col-12">
                        <div class="p-3 border bg-light">Custom column padding</div>
                    </div>
                    <div class="col-4">
                        <div class="p-3 border bg-light">Custom column padding</div>
                    </div>
                    <div class="col-4">
                        <div class="p-3 border bg-light">Custom column padding</div>
                    </div>
                    <div class="col-4">
                        <div class="p-3 border bg-light">Custom column padding</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="p-3 border bg-light">Custom column padding</div>
        </div>
        <div class="col-6">
            <div class="container">
                <div class="row g-2">
                    <div class="col-6">
                        <div class="p-3 border bg-light">Custom column padding</div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 border bg-light">Custom column padding</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="p-3 border bg-light">Custom column padding</div>
        </div>
    </div>
</div>

