<?php

namespace Controller;

use Model\Cart;
use Model\CartProduct;
use Model\OrderItems;
use Model\OrderUser;

class OrderItemsController extends Controller
{
    private OrderItems $orderItemsModel;
    private OrderUser $orderUserModel;
    private Cart $cartModel;

    public function __construct()
    {
        $this->orderItemsModel = new OrderItems();
        $this->orderUserModel = new OrderUser();
        $this->cartModel = new Cart();
    }

    public function addProductsInOrder(int $userId,int $orderId)
    {
        $basket = $this->cartModel->getCartByUserId($userId);
        $products = $this->cartModel->getProductsFromCartByUserId($basket['id']);
        if ($products) {
            foreach ($products as $product) {
                $this->orderItemsModel->addOrderItem($product, $orderId);
            }
        }
    }

}