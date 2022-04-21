<?php

require("../common/session.php");

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
        // TODO
    }

    private static function generate_normal()
    {
        $questions =
            [
                [
                    "title" => "Compétences",
                    "items" => [
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
                    "items" => [
                        "Rigueur et qualité du travail",
                        "Respect des plannings",
                        "Respect des coûts",
                        "Réalisation des objectifs",
                    ],
                    "textarea" => "Evaluation qualitative"
                ],
                [
                    "title" => "Qualités Comportementales",
                    "items" => [
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

        echo "<div>Critères D'évaluation</div>";

        $quesId = 0;
        foreach ($questions as $ques)
        {
            $quesId++;

            echo '<div class="question">';
            echo '<div>' . $quesId . '. ' . $ques["title"] . ':</div>';

            if (isset($ques["items"]))
            {
                echo <<<EOD
                <img class="rating-emoji" title="Très bien" src="/static/img/rating-emojis/great.svg">
                <img class="rating-emoji" title="Bien" src="/static/img/rating-emojis/good.svg">
                <img class="rating-emoji" title="Moyen" src="/static/img/rating-emojis/normal.svg">
                <img class="rating-emoji" title="Non satisfaisant" src="/static/img/rating-emojis/bad.svg">
                EOD;

                $itemId = 0;
                foreach ($ques["items"] as $item)
                {
                    $itemId++;
                    $fullId = $quesId . $itemId;
                    echo <<<EOD
                            <label>{$quesId}.{$itemId}. {$item}</label>
                            <input type="radio" name="C{$fullId}" value="A">
                            <input type="radio" name="C{$fullId}" value="B">
                            <input type="radio" name="C{$fullId}" value="C">
                            <input type="radio" name="C{$fullId}" value="D">                                
                            EOD;
                }
            }

            if(isset($ques["textarea"]))
            {
                $class = ' class="large"';

                if(!empty($ques["textarea"]))
                    echo "<label>".$ques["textarea"].":</label>";

                echo "<textarea".$class." name=QE".$quesId."></textarea>";
                echo "</div>";
            }

           
        }
    }
}
