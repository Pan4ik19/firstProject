<?php
namespace Model;

class Model
{
    protected \PDO $pdo;
    public function __construct()
    {

        $connection =getenv('DB_CONNECTION');
        $host = getenv('DB_HOST');
        $dataBase =getenv('DB_DATABASE');
        $username=getenv('DB_USERNAME');
        $password=getenv('DB_PASSWORD');
        $this->pdo= new \PDO("$connection:host={$host};dbname={$dataBase}",
            "{$username}", "{$password}");
    }
}