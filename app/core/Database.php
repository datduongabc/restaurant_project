<?php
require_once __DIR__ . '/../../config/database.php';
class Database
{
    // Singleton Pattern
    private static $instance = null;
    private $pdo;

    private function __construct()
    {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // debug
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // return array
            PDO::ATTR_EMULATE_PREPARES   => false, // prevent SQL injection
        ];

        try {
            $this->pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->pdo;
    }
}
