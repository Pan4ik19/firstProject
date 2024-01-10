<?php

namespace Controller;

use Model\Cart;
use Model\CartProduct;

class CartProductController extends Controller
{
    private Cart $cartModel;
    private CartProduct $cartProduct;

    public function __construct()
    {
        $this->cartModel = new Cart();
        $this->cartProduct = new CartProduct();
    }
    public function addProductInCart(array $data)
    {
        $userId = $this->getUserId();
        if(!$userId){
            $this->getLoginLocation();
        }elseif(!$data){
            $this->getMainLocation();
        }else{
            $basket = $this->cartModel->getCartByUserId($userId);
            if($basket){
                $data['cartId'] = $basket['id'];
                $this->cartProduct->addProduct($data);
            }else{
                $this->cartModel->createCart($userId);
                $this->cartProduct->addProduct($data);
            }
            $this->getMainLocation();
        }
    }
}