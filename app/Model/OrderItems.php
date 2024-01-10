<?php

namespace Model;

class OrderItems extends Model
{
    public function getItemsByUserId(int $userId):array|false
    {
        $statement = $this->pdo->prepare('SELECT * FROM order_items 
                                                WHERE order_user_id =: user_id');
        $statement->execute(['user_id'=>$userId]);
        return $statement->fetchAll();
    }

    public function addOrderItem(array $data,int $orderId)
    {
        $statement = $this->pdo->prepare('INSERT INTO order_items(order_id, product_id, quantity)
                                                VALUES(:order_id,:product_id,:quantity)');
        $statement->execute(['order_id'=>$orderId,'product_id'=>$data['product_id'],'quantity'=> $data['quantity']]);

    }

}