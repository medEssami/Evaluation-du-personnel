<?php
require("../common/session.php");
require("./company.php");

if (!Session::current() || Session::current()->get_user_role() != UserRole::Admin)
    header("Location: /");

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $errormsg = Company::updateCompanyInfo('name', 'logo', 'site', 'year');    

    if($errormsg)    
        echo "<div class='popup error'>Enregistrement échoué:<br>".$errormsg."</div>";                   
    else    
        echo "<div class='popup success'>Information enregistré avec succées.</div>";       
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
    <link rel="stylesheet" href="/static/css/admin.css">  
    <link rel="stylesheet" href="/static/css/popup.css">
    <script src="/static/js/jquery-3.6.0.min.js"></script>
    <script src="/static/js/popup.js"></script>
</head>
<body>
    <div id="header">
        <a href="/" class="button" title="Retourner à la page d'acceuil">
            <img class="img" src="/static/img/icons/home.svg">
        </a>
        <span class="title">Espace Administration</span>
        <?php echo "<span>".Company::PrintHeader()."</span>" ?>
    </div>
    <div class="main">
        <span>Informations sur la société</span>
        <form id="company-info-form" action="" method="POST" enctype="multipart/form-data">
            <label>Nom:</label>
            <input type="text" name="name" value="<?php echo Company::$Name	?>">
            <label>Logo:</label>
            <input id="input-logo" type="file" name="logo" accept="image/jpg">
            <img id="img-logo" src="<?php echo Company::$Logo	?>">
            <label>Site:</label>
            <input type="text" name="site" value="<?php echo Company::$Site	?>">
            <label>Année d'évaluation:</label>
            <input type="number" name="year" min="2000" max="2200" step="1" value="<?php echo Company::$Year ?>" />
            <input type="submit" class="big button cyan" value="Enregistrer">
        </form>
    </div>
    <script src="/static/js/admin.js"></script>
</body>