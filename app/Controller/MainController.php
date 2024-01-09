<?php

namespace Controller;
use Model\Basket;
use Model\Product;

class MainController
{
    private Product $productModel;

    private Basket $basketModel;

    public function __construct()
    {
        $this->productModel = new Product();
        $this->basketModel = new Basket();
    }

    public function getMain()
    {
        require_once './../View/main.php';
    }
    public function isSession():bool
    {
        if(!isset($_SESSION['user_id']))
        {
            header("Location:/login");
            return false;
        }
        return true;
    }
    public function getProducts()
    {
        session_start();
        $flagSession = $this->isSession();
        $products = $this->productModel->getALL();
        require_once './../View/main.php';

    }
    public function logout()
    {
        session_start();
        unset($_SESSION['user_id']);
        header('Location: /login');
    }

    public function getBasket()
    {
        session_start();
        $flagSession = $this->isSession();
        $basket = $this->basketModel->getBasketByUserId($_SESSION['user_id']);
        if($basket){
            $basketWithProducts = $this->basketModel->getProductsFromBasket($basket['id']);
            require_once './../View/basket.php';
        }
    }

    public function addProductInBasket(array $data)
    {
        session_start();
        $userId = $_SESSION['user_id'];
        //$data['userId'] = $userId;
        $basket = $this->basketModel->getBasketByUserId($userId);
        if($basket){
            $data['cartId'] = $basket['id'];
            $this->basketModel->addProduct($data);
        }else{
            $this->basketModel->createBasket($userId);
            $this->basketModel->addProduct($data);
        }
        header('Location:/main');
    }
}