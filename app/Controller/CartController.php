<?php

namespace Controller;

use Model\Cart;

class CartController extends Controller
{

    private Cart $cartModel;
    public function __construct()
    {
        $this->cartModel= new Cart();
    }

    public function getCart()
    {
        $userId = $this->getUserId();
        if (!$userId){
            $this->getLoginLocation();
        }else{
            $basket = $this->cartModel->getCartByUserId($userId);
            $basketWithProducts = $this->cartModel->getProductsFromCartByUserId($basket['id']);
            require_once './../View/basket.php';
        }

    }
}