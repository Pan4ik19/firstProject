<?php

class MainController
{

    public function getMain()
    {
        require_once './../View/main.php';
    }
    public function getProducts()
    {
        session_start();
        if(!isset($_SESSION['user_id']))
        {
            header("Location:/login");
        }else{
            $pdo = new \PDO("pgsql:host=db;dbname=postgres", "postgres", "postgres");
            $statement = $pdo->query("SELECT * FROM products");
            $products = $statement->fetchAll();
            require_once './../View/main.php';
        }
    }
}