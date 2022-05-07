<?php
define('SITE_ROOT', $_SERVER['DOCUMENT_ROOT']);
define('COMPANY_LOGO_IMAGE_RELATIVE_PATH', "/uploads/logo/company_logo.jpg");
define('COMPANY_LOGO_IMAGE_PATH', SITE_ROOT . COMPANY_LOGO_IMAGE_RELATIVE_PATH);

class Company
{
    public static $Name = "Test Company";
    public static $Logo = "/static/img/company-logo-placeholder.png";
    public static $Site = "site";
    public static $Year = 2022;

    public static function Init()
    {
        $query = Database::instance()->prepare("SELECT name,site,survey_year FROM company WHERE id=1");

        // Bind and execute
        $query->execute();
        $result = $query->get_result();

        // Check if username exists
        if (!$result || $result->num_rows != 1)
            return;

        $row = $result->fetch_assoc();

        // Check if password hash is correct
        self::$Name = $row['name'];
        self::$Site = $row['site'];
        self::$Year = $row['survey_year'];

        if(file_exists(COMPANY_LOGO_IMAGE_PATH))
        {
            // We add the current timestamp in order to prevent caching and force update.            
            self::$Logo = COMPANY_LOGO_IMAGE_RELATIVE_PATH ."?". Date('U');
        }
    }

    public static function PrintHeader()
    {
        $name = self::$Name;        
        $logo = self::$Logo;
        echo <<<EOD
        <div id="header-company">
            <span>{$name}</span>
            <img id="header-company-logo" src="{$logo}">
        </div>
        EOD;
    }

    public static function updateCompanyInfo($name, $logo, $site, $year): ?string
    {
        // Upload/Update logo
        $is_logo_set = array_key_exists($logo, $_FILES);
        if ($is_logo_set)
        {
            $errormsg = self::uploadCompanyLogo($_FILES[$logo]);

            if ($errormsg)
                return $errormsg;
        }

        $name = $_POST[$name];
        $site = $_POST[$site];
        $year = $_POST[$year];

        $updated_values = [];
        $updated_values_sql = "";

        // Update name
        if (isset($name) && !empty($name))
        {
            $updated_values_sql .= "name=?";
            array_push($updated_values, $name);
        }

        if (isset($site) && !empty($site)) {
            $updated_values_sql .= ",site=?";
            array_push($updated_values, $site);
        }

        if (isset($year) && !empty($year)) {
            $updated_values_sql .= ",survey_year=?";
            array_push($updated_values, $year);
        }

        
        if(!$is_logo_set && empty($updated_values))
            return "";

        $updated_values_sql = ltrim($updated_values_sql, ",");

        // Prepare statement: get the password hash for this username.
        $query = Database::instance()->prepare("UPDATE company SET " . $updated_values_sql . " WHERE id=1");
        
        if(! $query->execute($updated_values))
            return "Désolé, nous n'avons pas pu mettre à jour la base de donnée.";

        // Update cached info
        self::Init();

        return null;
    }

    private static function uploadCompanyLogo($logo_file): ?string
    {
        if (!file_exists($logo_file['tmp_name']) || !is_uploaded_file($logo_file['tmp_name']))
            return null; // Logo upload isn't required

        $logo_type = strtolower(pathinfo(COMPANY_LOGO_IMAGE_PATH, PATHINFO_EXTENSION));

        if ($logo_type != "jpg")
            return "Désolé, seule les types JPG sont permis pour le logo.";

        // Check file size
        if ($logo_file["size"] > 500000)
            return "Désolé, la taille de l'image est trop volumineuse.";


        if (move_uploaded_file($logo_file["tmp_name"], COMPANY_LOGO_IMAGE_PATH))
            return null;

        return "Désolé, nous n'avons pas pu télécharger le logo.";
    }
}

Company::Init();