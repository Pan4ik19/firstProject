<?php

require_once './../Model/Product.php';
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
        session_start();
        if(!isset($_SESSION['user_id']))
        {
            header("Location:/login");
        }else{
            $products = $this->productModel->getALL();
            require_once './../View/main.php';
        }
    }
}