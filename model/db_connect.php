<?php
class Database {
    private static $instance = null;
    private $pdo;

    private function __construct($host, $db, $user, $pass, $charset) {
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $this->pdo = new PDO($dsn, $user, $pass, $opt);
    }

    public static function getInstance($host = '127.0.0.1', $db = 'basma', $user = 'root', $pass = '', $charset = 'utf8mb4') {
        if (self::$instance == null) {
            self::$instance = new Database($host, $db, $user, $pass, $charset);
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->pdo;
    }
}
?>
