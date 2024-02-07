<?php
namespace core;

use core\Config;
use Dotenv\Dotenv;
use PDO;
use PDOException;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();
class Database
{
    private static $instance = null;
    private static $config = Config::getConfig();
    private static $connection = [];
    private function __construct()
    {
        $user = $_ENV["user"];
        $pass = $_ENV["pass"];
        $dsn = 'mysql:' . http_build_query(self::$config['Database'], '', ';');

        self::$connection =
            [
                'user' => $user,
                'pass' => $pass,
                'dsn' => $dsn
            ];
    }
    public function getConnection()
    {
        try {
            $pdo = new PDO(self::$connection['dsn'], self::$connection['user'], self::$connection['pass']);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection Failed:" . $e->getMessage();
            die();
        }
        return $pdo;
    }
    public function query($sql, $option)
    {
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute();
        return $stmt->$option;
    }

    public function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Database;
        }

        return self::$instance;
    }
}