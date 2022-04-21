<?php

class Database {

    private static $db;
    private $conn;

    private function __construct() {
        $this->conn = new mysqli('localhost', 'root', '12345', 'evaldb');
    }

    function __destruct() {
        $this->conn->close();
    }

    public function error() {
        return $this->conn->connect_error;
    }

    public static function instance() {
        if (self::$db == null) {
            self::$db = new Database();
        }
        return self::$db->conn;
    }
}

?>