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



<script>
    $(document).ready(function() {
        $(".show-toast").click(function() {
        $("#myToast").toast('show');
            
        });
    });
</script>

<div class="container mt-4">
    <button type="button" class="btn btn-primary show-toast">Show Toast</button>
</div>

<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 5">
    <div id="myToast" class="toast hide" role="alert" data-autohide="false" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <!-- <img src="assets/icons/stickies-fill.svg" class="me-2" alt="..."> -->
            <strong class="me-auto">Bootstrap</strong>
            <small>11 mins ago</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <!-- <div class="toast-body"> -->
            <div class="toast-body alert alert-success alert-toast" role="alert">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Extionem laborum optio voluptate nobis harum minima alias!
            </div>
        <!-- </div> -->
    </div>
</div>