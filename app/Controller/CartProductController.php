<?php

namespace Controller;

use Model\Cart;
use Model\CartProduct;

class CartProductController
{
    private Cart $cartModel;
    private CartProduct $cartProduct;

    public function __construct()
    {
        $this->cartModel = new Cart();
        $this->cartProduct= new CartProduct();
    }
    public function addProductInCart(array $data)
    {
        session_start();
        $userId = $_SESSION['user_id'];
        //$data['userId'] = $userId;
        $basket = $this->cartModel->getCartByUserId($userId);
        if($basket){
            $data['cartId'] = $basket['id'];
            $this->cartProduct->addProduct($data);
        }else{
            $this->cartModel->createCart($userId);
            $this->cartProduct->addProduct($data);
        }
        header('Location:/main');
    }
}