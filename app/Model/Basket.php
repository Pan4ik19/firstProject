<?php

namespace Model;

class Basket extends Model
{
    public function createBasket(int $userId)
    {
        $user = new User();
        $userInfo = $user->getOneById($userId);
        $statement = $this->pdo->prepare("insert into carts(name,user_id) values(:name,:userId)");
        $statement->execute(['name' =>$userInfo['name']."$userId" , 'userId' => $userId]);
    }

    public function getBasketByUserId($userId): array|false
    {
        $statement = $this->pdo->prepare('SELECT * FROM carts where user_id= :userId');
        $statement->execute(['userId' => $userId]);
        return $statement->fetch();
    }

    public function addProduct($data) // $data = [productId,userId,quantity]
    {
        $statement = $this->pdo->prepare("insert into cart_product(cart_id, product_id, quantity) 
                                                    values(:cartId,:productId,:quantity)");
        $statement->execute(['cartId' => $data['cartId'],
                            'productId' => $data['productId'],
                            'quantity' => $data['quantity']
        ]);
    }
}