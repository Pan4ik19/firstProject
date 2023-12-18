<?php
    session_start();
   if(!isset($_SESSION['user_id']))
    {
        header("Location:/login");
    }

$pdo = new \PDO("pgsql:host=db;dbname=postgres", "postgres", "postgres");
$statement = $pdo->query("SELECT * FROM products ");
$products = $statement->fetchAll();




require_once './html/main.php';
?>

