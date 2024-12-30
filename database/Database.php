<?php
class Database {
    private static $instance = null;
    private $conn;

    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $dbname = "mbti"; // Replace with your database name

    // Private constructor to prevent multiple instances
    private function __construct() {
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Static method to get the single instance of Database
    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    // Method to get the connection
    public function getConnection() {
        return $this->conn;
    }
}
?>
