<?php

namespace Controller;
use Model\Basket;
use Model\Product;

class MainController extends Controller
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
            $this->getLoginLocation();
        }else{
            $products = $this->productModel->getALL();
            require_once './../View/main.php';
        }
    }

    public function logout()
    {
        session_start();
        unset($_SESSION['user_id']);
        $this->getLoginLocation();
    }
}