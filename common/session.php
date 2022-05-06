<?php

require("db.php");

define('MAX_USERNAME_LENGTH', 32);
define('MAX_PASSWORD_LENGTH', 32);

session_start();

enum UserRole
{
    case None;
    case Admin;
    case Director;
    // case HR; // Humain Resources ??
}

class Session
{
    private $userid;
    private $username;
    private $user_role;

    private function __construct($userid, $username, $user_role)
    {
        $this->userid = $userid;
        $this->username = $username;
        $this->user_role = $user_role;
    }

    public function get_user_role(): UserRole
    {
        switch ($this->user_role)
        {
            case 'admin':
                return UserRole::Admin;
            case 'director':
                return UserRole::Director;
            //case 'hr':
              //  return UserRole::HR;
            default:
                return UserRole::None;
        }
    }

    public static function login($username, $password): bool
    {
        if (self::current() !== null)
            return false;

        $username = $_POST[$username];
        $password = $_POST[$password];

        // Check if login params are set
        if (!isset($username) || !isset($password))
            return false;

        // Check login params lengths
        if (strlen($username) > MAX_USERNAME_LENGTH || strlen($password) > MAX_PASSWORD_LENGTH)
            return false;

        // Prepare statement: get the password hash for this username.
        $query = Database::instance()->prepare("SELECT userid,password,role FROM users WHERE username=? LIMIT 1");

        // Bind and execute
        $query->bind_param("s", $username); // "s" means that $username is bound as a string.
        $query->execute();
        $result = $query->get_result();

        // Check if username exists
        if (!$result || $result->num_rows != 1)
            return false;

        $row = $result->fetch_assoc();

        // Check if password hash is correct
        if (hash("sha256", $password) != $row['password'])
            return false;

        // Update user session data
        $_SESSION['session'] = new Session($row['userid'], $username, $row['role']);

        return true;
    }

    public static function logout()
    {
        $_SESSION['session'] = null;
    }

    public static function current(): ?Session
    {
        return isset($_SESSION['session']) ? $_SESSION['session'] : null;
    }
}
