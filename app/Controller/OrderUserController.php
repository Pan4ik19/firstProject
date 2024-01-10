<?php

namespace Controller;

use Model\OrderUser;

class OrderUserController extends Controller
{
    private OrderItemsController $orderItemsController;
    private OrderUser $orderUserModel;

    public function __construct()
    {
        $this->orderItemsController = new OrderItemsController();
        $this->orderUserModel = new OrderUser();
    }

    public function createOrder(array $data)
    {
        $userId = $this->getUserId();
        if(empty($userId)){
            $this->getLoginLocation();
        }else{
            $data['userId'] = $userId;
            $orderId = $this->orderUserModel->createOrder($data);
            $this->orderItemsController->addProductsInOrder($userId,$orderId);
        }
        $this->getMainLocation();
    }
}