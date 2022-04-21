<?php
require("../common/session.php");

if(Session::current())
{
    header('Location: /');
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(Session::login($_POST['username'], $_POST['password']))    
        header('Location: /');    
    else    
        echo "<div class='popup error'>Email ou mot de passe invalide.</div>";       
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Evaluation du Peronnel</title>
    <link rel="stylesheet" href="/static/css/global.css">
    <link rel="stylesheet" href="/static/css/home.css">
    <link rel="stylesheet" href="/static/css/login.css">
    <link rel="stylesheet" href="/static/css/popup.css">
    <script src="/static/js/jquery-3.6.0.min.js"></script>
    <script src="/static/js/popup.js"></script>
</head>

<body>
    <div id="header">
        <a href="/" class="button" title="Retourner à la page d'acceuil">
            <img class="img" src="/static/img/icons/home.svg">
        </a>
        <span class="title">Login</span>
        <div id="header-company">
            <span>COMPANY_NAME</span>
            <img id="header-company-logo" src="/static/img/company-logo-placeholder.png">
        </div>
    </div>
    <div class="main">
        <span>Connecter vous</span>
        <form id="login-form" action="" method="POST">
            <input type="text" name="username" placeholder="Nom d'utilisateur" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <input type="submit" class="big button cyan" value="Se connecter">
        </form>
    </div>
    <img class="polygon-overlay" src="/static/img/backgrounds/login-polygon-overlay.png">
</body>