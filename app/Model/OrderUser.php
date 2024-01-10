<?php

namespace Model;

class OrderUser extends Model
{
    public function createOrder(array $data)
    {
        $statement = $this->pdo->prepare('INSERT INTO order_user(user_id, phone, address,price)  
                                                VALUES (:user_id, :phone, :address, :price) ');
        $statement->execute(['user_id'=>$data['userId'], 'phone'=>$data['phone'], 'address'=>$data['address'], 'price'=>$data['totalPrice']]);
        return $this->pdo->lastInsertId();
    }
    public function getOrdersByUserid(int $userId):array|false
    {
        $statement = $this->pdo->prepare('SELECT * FROM order_user
                                                WHERE user_id =: userId');
        $statement->execute(['user_id'=>$userId]);
        return $statement->fetchAll();
    }

}