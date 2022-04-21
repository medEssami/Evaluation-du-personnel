<?php require('common/session.php'); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Evaluation du Peronnel</title>
    <link rel="stylesheet" href="/static/css/global.css">    
    <link rel="stylesheet" href="/static/css/home.css">    
    <script src="/static/js/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div id="header">
        <div class="item">
            <img class="img" src="/static/img/icons/home.svg">
            <span class="title">Acceuil</span>
        </div>
        <div id="header-company">
            <span>COMPANY_NAME</span>
            <img id="header-company-logo" src="/static/img/company-logo-placeholder.png">
        </div>
    </div>    
    <div class="main">
        <span>Platform d'évaluation du Personnel</span>
        <?php 
            if(Session::current())
            {
                if(Session::current()->get_user_role() == UserRole::Admin)
                    echo '<a href="/admin" class="big button dark">Espace Admin</a>';
                else
                    echo '<a href="/login/logout.php" class="big button dark">Se déconnecter</a>';
            }                
            else
            {
                echo '<a href="/login" class="big button dark">Se connecter</a>';            
            }
        ?>        
        <a href="/survey" class="big button cyan">Évaluation du personnel</a>
    </div>
    <img class="polygon-overlay" src="/static/img/backgrounds/survey-polygon-overlay.png">
</body>