<?php if (session()->get('isLoggedIn')) : ?>
    </div>
    </div>
    </div>
<?php endif ?>

<!-- <footer class="bg-dark">
    <?php
    $page = $_SERVER['REQUEST_URI'];
    echo ('Page en cours : ' . $page);
    ?>
</footer> -->

<?php if (!session()->get('isLoggedIn')) : ?>
<footer>
    <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
        <defs>
            <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
        </defs>
        <g class="parallax">
            <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.2)" />
            <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.15)" />
            <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
            <use xlink:href="#gentle-wave" x="48" y="7" fill="rgba(255,255,255,0.5)" />
        </g>
    </svg>
</footer>
<?php endif ?>

</body>

</html>