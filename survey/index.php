<?php 

require ("generator.php"); 
require ("uploader.php"); 

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(SurveyUploader::upload("fullname", "position", "job", "evaldate", "recruitdate", "seniority"))
        echo "<div class='popup success'>Information enregistré avec succées.</div>";       
    else
        echo "<div class='popup error'>Désolé, l'opération a échouée.</div>";       
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Evaluation du Peronnel</title>
    <link rel="stylesheet" href="/static/css/global.css">
    <link rel="stylesheet" href="/static/css/survey.css">
    <link rel="stylesheet" href="/static/css/popup.css">    
    <script src="/static/js/jquery-3.6.0.min.js"></script>
    <script src="/static/js/popup.js"></script>
</head>

<body>
    <div id="header">
        <a href="/" class="button" title="Retourner à la page d'acceuil">
            <img class="img" src="/static/img/icons/home.svg">
        </a>
        <span class="title">Fiche d'Evaluation Du Personnel - Année <?php echo Company::$Year?></span>
        <?php echo "<span>".Company::PrintHeader()."</span>" ?>
    </div>
    <form id="main-form" class="survey-form" method="POST" action="">
        <section class="section">
            <div>Identité de l'évalue</div>
            <div id="identity-form">
                <label class="required">Nom et prénom:</label>
                <input type="text" name="fullname" required/>

                <label class="required">Emploi attribué:</label>
                <input type="text" name="job" required/>

                <label class="required">Poste occupé:</label>
                <input type="text" name="position" value="<?php echo (Session::current() && Session::current()->get_user_role() == UserRole::Director) ? "Directeur" : "" ?>" required/>

                <label class="required">Date de l'évaluation:</label>
                <input type="date" name="evaldate" required/>

                <label class="required">Date de recrutement:</label>
                <input type="date" name="recruitdate" required/>

                <label class="required">Ancienneté dans le poste:</label>
                <input type="number" name="seniority" value="0" min="0" required/>

                <label>Brève description du poste de l'évalue:</label>
                <textarea class="large" name="BREVE_DESCRIPTION_DU_POSTE"></textarea>

                <label>Principales réalisations de l'évalue durant la période ecoulée au regard des objectifs qui lui ont éte fixés:</label>
                <textarea class="large" name="PRINCIPALES_REALISATIONS"></textarea>
            </div>
        </section>
        <section class="section">        
            <?php SurveyGenerator::generate(); ?>            
        </section>   
        <input class="button big cyan" type="submit" value="Envoyé">     
    </form>
    <script src="/static/js/survey.js"></script>
</body>

</html>