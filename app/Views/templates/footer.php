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


<footer>
    <?php if (!session()->get('isLoggedIn')) : ?>
        <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
            <defs>
                <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
            </defs>
            <g class="parallax">
                <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.3)" />
                <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.25)" />
                <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.4)" />
                <use xlink:href="#gentle-wave" x="48" y="7" fill="rgba(255,255,255,0.6)" />
            </g>
        </svg>
        <?php else : ?>
        <!-- <div>
            <button class="btn btn-secondary" onclick="retourHaut()" id="haut" title="Retour haut de page">Haut</button>
            <button class="btn btn-outline-secondary btn-icon" onclick="retourHaut()" id="haut" title="Retour haut de page"><img src="assets/icons/up-chevron.png" alt="Modifier"></button>
        </div> -->

        <!-- BOUTTON RETOUR -->
<!--         
        <div>
            <img onclick="retourHaut()" id="haut" src="assets/icons/up1.png" alt="Haut de page" title="Retour haut page">
        </div> -->

    <?php endif ?>
</footer>

</body>


<!-- <script>
    window.onscroll = function() {
        scrollFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
            // document.getElementById("haut").style.display = "block";
            document.getElementById("haut").style.opacity = "1";
            document.getElementById("haut").style.cursor = "pointer";
            document.getElementById("haut").style.transitionDuration = "0.5s";
        } else {
            // document.getElementById("haut").style.display = "none";
            document.getElementById("haut").style.opacity = "0";
            document.getElementById("haut").style.cursor = "default";
        }
    }

    function retourHaut() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
</script> -->

</html>