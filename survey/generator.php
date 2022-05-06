<?php

require("../common/session.php");
require("../admin/company.php");

class SurveyGenerator
{
    public static function generate()
    {
        if (Session::current() && Session::current()->get_user_role() == UserRole::Director)
            self::generate_director();
        else
            self::generate_normal();
    }

    private static function generate_director()
    {
        $questions = 
        [
            [
                "title" => "Émoluments mensuels bruts",
                "input_type" => "number"
            ],
            [
                "title" => "Prime de rendement proposée",
                "input_type" => "number"
            ],
            [
                "title" => "Réajustement de salaire proposé",
                "input_type" => "number",
                "input_ques" => [
                    [
                        "text" => "Date du dernier réajustement effectué",
                        "type" => "date"
                    ],
                    [
                        "text" => "Taux de réajustement de salaire proposé",
                        "type" => "text"
                    ]                   
                ]
            ],
            [
                "title" => "Reclassement proposé",
                "input_type" => "number",
                "input_ques" => [
                    [
                        "text" => "Nombre d'années d'expérience dans le groupe",
                        "type" => "number"
                    ],
                    [
                        "text" => "Nouvel emploi proposé",
                        "type" => "text"
                    ],
                    [
                        "text" => "Nouveau poste proposé",
                        "type" => "text"
                    ]
                ]
            ],
            [
                "title" => "Commentaires et propositions du dirigeant",
                "textarea" => ""
            ],
            [
                "title" => "Partie reservée a " . Company::$Name,
                "textarea" => ""
            ]            
        ];
        self::generate_html("Partie reservée au dirigeant de la societe", $questions);
    }

    private static function generate_normal()
    {
        $questions =        
            [
                [
                    "title" => "Compétences",
                    "rate_ques" => [
                        "Connaissances de base en relation avec la formation initiale",
                        "Connaissances professionnelles liées au poste occupé",
                        "Capacité de gestion des équipes",
                        "Capacités d'expression écrite et orale",
                        "Potentiel d'apprentissage et d'évolution"
                    ],
                    "textarea" => "Evaluation qualitative"
                ],
                [
                    "title" => "Productivité et Efficiencé",
                    "rate_ques" => [
                        "Rigueur et qualité du travail",
                        "Respect des plannings",
                        "Respect des coûts",
                        "Réalisation des objectifs",
                    ],
                    "textarea" => "Evaluation qualitative"
                ],
                [
                    "title" => "Qualités Comportementales",
                    "rate_ques" => [
                        "Assiduité et ponctualité",
                        "Esprit d'initiative",
                        "Persévérance dans l'effort",
                        "Relations humaines",
                        "Adhésion aux valeurs du groupe"
                    ],
                    "textarea" => "Evaluation qualitative"
                ],
                [
                    "title" => "Évaluation générale de la hiérarchie",
                    "textarea" => ""
                ],
                [
                    "title" => "Commentaires de l'évalue",
                    "textarea" => ""
                ],
                [
                    "title" => "Objectifs à atteindre au terme de la prochaine période d'évaluation",
                    "textarea" => ""
                ],
                [
                    "title" => "Évaluation générale de la hiérarchie",
                    "textarea" => ""
                ],
            ];

        
        self::generate_html("Critères D'évaluation", $questions);
    }

    private static function generate_html($title, $questions)
    {
        echo "<div>".$title."</div>";

        $quesId = 0;
        foreach ($questions as $ques)
        {
            $quesId++;
            $quesName = self::NameToID($ques["title"]);

            echo '<div class="question">';
            echo '<div>' . $quesId . '. ' . $ques["title"] . ':</div>';

            // Rating questions
            if (isset($ques["rate_ques"]))
            {
                echo <<<EOD
                <img class="rating-emoji" title="Très bien\nNiveau de performance remarquable et de très haute qualité, dépassant ce qui est normalement attendu pour le poste." src="/static/img/rating-emojis/great.svg">
                <img class="rating-emoji" title="Bien\nNiveau de performance bon correspondant à celui exigé pour la majeure partie des employés affectés au même poste" src="/static/img/rating-emojis/good.svg">
                <img class="rating-emoji" title="Moyen\nNiveau correspondant au seuil minimum acceptable pour le poste occupé." src="/static/img/rating-emojis/normal.svg">
                <img class="rating-emoji" title="Non satisfaisant\nNiveau nettement inférieur à celui exigé par le poste, donc inacceptable." src="/static/img/rating-emojis/bad.svg">
                EOD;

                $itemId = 0;
                foreach ($ques["rate_ques"] as $item)
                {
                    $itemId++;
                    $grpName = self::NameToID($item);
                    echo <<<EOD
                            <label>{$quesId}.{$itemId}. {$item}</label>
                            <input type="radio" name="{$grpName}" value="A" required>
                            <input type="radio" name="{$grpName}" value="B">
                            <input type="radio" name="{$grpName}" value="C">
                            <input type="radio" name="{$grpName}" value="D">                                
                            EOD;
                }
            }

            // Input field (Director)
            if(isset($ques["input_type"]))
            {
                echo '<input class="input-ques" type="'.$ques["input_type"].'" name="'.$quesName.'">';
            }

            if(isset($ques["input_ques"]))
            {
                $itemId = 0;
                foreach ($ques["input_ques"] as $item)
                {
                    $itemId++;
                    $fullId = $quesId . $itemId;

                    echo '<label>'.$quesId.'.'.$itemId.' '.$item["text"].'</label>';
                    echo '<input class="input-ques" type="'.$item["type"].'" name="'.self::NameToID($item["text"]).'">';                    
                }
            }

            // Text area
            if(isset($ques["textarea"]))
            {
                $class = ' class="large"';

                if(!empty($ques["textarea"])) 
                {
                    echo "<label class='indented'>".$ques["textarea"].":</label>";
                    $quesName = "EQ_".$quesName;
                }                    

                echo "<textarea".$class." name='".$quesName."'></textarea>";                
            }    

            echo "</div>";
        }
    }

    private static function NameToID(string $name): string
    {
        $name = strtr(utf8_decode($name), utf8_decode('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'), 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
        $name = strtoupper($name);
        $name = str_ireplace([" ", "'"], "_", $name);
        return $name;
    }
}
