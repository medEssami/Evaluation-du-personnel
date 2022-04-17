<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./../static/css/global.css">
    <link rel="stylesheet" href="./../static/css/survey.css">
    <title>Evaluation du Peronnel</title>
    <script src="./../static/js/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div id="header">
        <span id="header_title">Fiche d'Evaluation Du Personnel / Année 2020</span>
        <div id="header_company">
            <img id="header_company_logo" src="./../static/img/company_logo_placeholder.png">
            <span>COMPANY_NAME</span>
        </div>
    </div>
    <form id="main_form" class="survey_form">
        <section class="section">
            <div>Identité de l'évalue</div>
            <div id="identity_form">
                <label>Nom et prénom:</label>
                <input type="text" />

                <label>Emploi attribué :</label>
                <input type="text" name="emlpo" />

                <label>Poste occupé :</label>
                <input type="text" name="poste" />

                <label>Date de l’évaluation: </label>
                <input type="date" name="date_eval" />

                <label>Date de recrutement: </label>
                <input type="date" name="date_rec" />

                <label>Ancienneté dans le poste :</label>
                <input type="number" name="aciennete" value="0" min="0" />

                <label>Breve description du poste de l'évalue:</label>
                <textarea name="desc_poste"></textarea>

                <label>Principales realisations de l'evalue durant la periode ecoulée au regard des objectifs qui lui ont éte fixes:</label>
                <textarea name="real_eval"></textarea>
            </div>
        </section>
        <section class="section">
            <div>Critère D'évaluation</div>            
                <?php
                    $questions =  [
                        [
                            "title" => "Compétences",
                            "items" => [
                                "Connaissances de base en relation avec la formation initiale",
                                "Connaissances professionnelles liées au poste occupé",
                                "Capacité de gestion des équipes",
                                "Capacités d'expression écrite et orale",
                                "Potentiel d'apprentissage et d'évolution"
                            ]
                        ],
                        [
                            "title" => "Productivité et Efficiencé",
                            "items" => [
                                "Rigueur et qualité du travail",
                                "Respect des plannings",
                                "Respect des coûts",
                                "Réalisation des objectifs",
                            ]
                        ], 
                        [
                            "title" => "Qualités Comportementales",
                            "items" => [
                                "Assiduité et ponctualité",
                                "Esprit d'initiative",
                                "Persévérance dans l'effort",
                                "Relations humaines",
                                "Adhésion aux valeurs du groupe"
                            ]
                        ],
                           
                    ];

                    $quesId = 0;
                    foreach ($questions as $ques) 
                    {
                        $quesId++;
                        
                        echo <<<EOD
                            <div class="question">
                            <div>{$quesId}. {$ques["title"]}</div>
                            <img class="rating-emoji" title="Très bien" src="./../static/img/rating_emojis/great.svg">
                            <img class="rating-emoji" title="Bien" src="./../static/img/rating_emojis/good.svg">
                            <img class="rating-emoji" title="Moyen" src="./../static/img/rating_emojis/normal.svg">
                            <img class="rating-emoji" title="Non satisfaisant" src="./../static/img/rating_emojis/bad.svg">
                            EOD;

                        $itemId = 0;
                        foreach ($ques["items"] as $item) 
                        {
                            $itemId++;
                            $fullId = $quesId.$itemId;
                            echo <<<EOD
                                <label>{$quesId}.{$itemId}. {$item}</label>
                                <input type="radio" name="C{$fullId}" value="A">
                                <input type="radio" name="C{$fullId}" value="B">
                                <input type="radio" name="C{$fullId}" value="C">
                                <input type="radio" name="C{$fullId}" value="D">                                
                                EOD;
                        }                        

                        echo <<<EOD
                            <label>Evaluation qualitative</label>
                            <textarea name="QE{$quesId}"></textarea>
                            </div>            
                        EOD;                        
                    }
                ?>                               
            
        </section>
    </form>
    <script src="./../static/js/survey.js"></script>
</body>

</html>