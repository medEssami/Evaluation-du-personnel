<?php require('common/session.php'); require('admin/company.php'); ?>
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
        <?php echo "<span>".Company::PrintHeader()."</span>" ?>
    </div>        
        <?php       
            $admin_class = null;          
            
            if(Session::current() && Session::current()->get_user_role() == UserRole::Admin)
                $admin_class = " admin";
                
            echo "<div class='main{$admin_class}'>";
            echo "<span class='{$admin_class}'>Platform d'évaluation du Personnel</span>";            
                          
            if(Session::current())
            {
                if($admin_class)
                    echo '<a href="/admin" class="big button dark">Espace Admin</a>';
                echo '<a href="/login/logout.php" class="big button dark">Se déconnecter</a>';       
            }
            else
                echo '<a href="/login" class="big button dark">Se connecter</a>';                          
        ?>        
        <a href="/survey" class="big button cyan">Évaluation du personnel</a>
    </div>
    <img class="polygon-overlay" src="/static/img/backgrounds/survey-polygon-overlay.png">
</body>