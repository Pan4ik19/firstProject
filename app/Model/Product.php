<?php

class Product
{
    private PDO $pdo;

    public function __construct()
    {
        require_once './../Model/storage.php';
        $this->pdo = $storagePdo;

    }

    public function getALL()
    {
        $statement = $this->pdo->query("SELECT * FROM products");
        return $statement->fetchAll();
    }
}