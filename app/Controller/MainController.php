<?php

namespace Controller;
use Model\Basket;
use Model\Product;

class MainController
{
    private Product $productModel;

    public function __construct()
    {
        $this->productModel = new Product();
    }

    public function getMain()
    {
        require_once './../View/main.php';
    }

    public function getProducts()
    {
        $flagSession = $this->getUserId();
        if(empty($flagSession))
        {
            header("Location:/login");
        }else{
            $products = $this->productModel->getALL();
            require_once './../View/main.php';
        }

    }

    public function getUserId():int|null
    {
        session_start();
        if(isset($_SESSION['user_id']))
        {
            return $_SESSION['user_id'];
        }
        return null;
    }

    public function logout()
    {
        session_start();
        unset($_SESSION['user_id']);
        header('Location: /login');
    }
}