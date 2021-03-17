<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <?php if (session()->get('isLoggedIn')) : ?>
        <style>
            body {
                background-image: url("#");
            }
        </style>

    <?php endif ?>
</head>

<body>
<?php
$page = $_SERVER['REQUEST_URI'];
?>
<header>
    
</header>