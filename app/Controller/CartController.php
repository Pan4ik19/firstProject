<?php

namespace Controller;

use Model\Cart;

class CartController
{
    private Cart $cartModel;
    public function __construct()
    {
        $this->cartModel= new Cart();
    }

    public function getCart()
    {
        session_start();
        $basket = $this->cartModel->getCartByUserId($_SESSION['user_id']);
        if(empty($basket)){
            header('Location: /login');
        }else{
            $basketWithProducts = $this->cartModel->getProductsFromBasket($basket['id']);
            require_once './../View/basket.php';
        }
    }
}