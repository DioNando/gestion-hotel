<?php if (session()->get('isLoggedIn')) : ?>
    </div>
    </div>
    </div>
<?php endif ?>

<footer class="bg-light">
    <?php
    $page = $_SERVER['REQUEST_URI'];
    echo ('Page en cours : ' . $page);
    ?>

</footer>



</body>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/jquery/jquery.min.js"></script>

</html>