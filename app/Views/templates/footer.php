<br><?php
$page = $_SERVER['REQUEST_URI'];
echo('Page en cours : ' . $page);
?>
<footer>
    <?php if (session()->get('isLoggedIn')) : ?>
        
    <?php endif ?>
</footer>

</body>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/jquery/jquery.min.js"></script>

</html>