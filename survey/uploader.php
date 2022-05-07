<?php

require_once("../common/session.php");
require_once("../admin/company.php");

class SurveyUploader
{
    public static function upload($full_name, $position, $job, $eval_date, $recruit_date, $seniority): bool
    {
        $full_name = $_POST[$full_name];
        $position = $_POST[$position];
        $job = $_POST[$job];
        $eval_date = $_POST[$eval_date];
        $recruit_date = $_POST[$recruit_date];
        $seniority = $_POST[$seniority];
        
        if(!isset($full_name) || !isset($position) || !isset($job) || !isset($eval_date) || !isset($recruit_date) || !isset($seniority))
            return false;

        $survey_respon_json = [];

        foreach ($_POST as $key => $value)
        {
            if(ctype_upper($key[0]))
            {
                $survey_respon_json [$key] = $value;
            }            
        }

        $survey_respon_json = json_encode($survey_respon_json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        $query = Database::instance()
        ->prepare("INSERT INTO surveys (employer_full_name, employer_position, employer_job, employer_recruitment_start_date, employer_seniority, survey_year, survey_date, survey_response_json) VALUES (?, ?, ?, ?, ?, ?, ?, ?);");
        
        $query->bind_param("ssssiiss", $full_name, $position, $job, $recruit_date, $seniority, Company::$Year, $eval_date, $survey_respon_json);

        if(! $query->execute())
            return "Désolé, nous n'avons pas pu mettre à jour la base de donnée.";

        return true;
    }
}
