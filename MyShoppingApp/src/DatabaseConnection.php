<?php

namespace MyShoppingApp;

use PDO;
use Dotenv\Dotenv;

class DatabaseConnection
{
    private $connection;

    public function __construct()
    {
        // Load the environment variables from the .env file
        $dotenv = Dotenv::createImmutable(__DIR__ . '/..');
        $dotenv->load();

        $dbHost = $_ENV['DB_HOST'];
        $dbName = $_ENV['MYSQL_DATABASE'];
        $dbUser = $_ENV['MYSQL_USER'];
        $dbPass = $_ENV['MYSQL_PASSWORD'];

        $this->connection = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
