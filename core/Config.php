<?php
namespace core;

class Config
{
    private static array $config = [
        'Database' => [
            'host' => $_ENV["db_host"],
            'port' => 3306,
            'dbname' => $_ENV["db_name"],
            'charset' => 'utf8mb4',
        ]
    ];

    public static function getConfig()
    {
        return self::$config;
    }
}