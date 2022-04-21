<?php
require("../common/session.php");

if (!Session::current() || Session::current()->get_user_role() != UserRole::Admin)
    header("Location: /");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Evaluation du Peronnel</title>
    <link rel="stylesheet" href="/static/css/global.css">
    <link rel="stylesheet" href="/static/css/croppie.css" />
    <script src="/static/js/jquery-3.6.0.min.js"></script>
    <script src="/static/js/croppie.js"></script>
</head>

<body>
    <div id="header">
        <a href="/" class="button" title="Retourner à la page d'acceuil">
            <img class="img" src="/static/img/icons/home.svg">
        </a>
        <span class="title">Espace Admin</span>
        <div id="header-company">
            <span>COMPANY_NAME</span>
            <img id="header-company-logo" src="/static/img/company-logo-placeholder.png">
        </div>
    </div>
    <form action="" method="POST">

    </form>
    <!-- or even simpler -->
    <!-- <img class="my-image" src="/static/img/company-logo-placeholder.png" />
    <script>
        $('.my-image').croppie();
    </script> -->
</body>