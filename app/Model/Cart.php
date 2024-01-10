<?php

namespace Model;

class Cart extends Model
{
    public function createCart(int $userId):void
    {
        $user = new User();
        $userInfo = $user->getOneById($userId);
        $statement = $this->pdo->prepare("insert into carts(name,user_id) values(:name,:userId)");
        $statement->execute(['name' =>$userInfo['name']."$userId" , 'userId' => $userId]);
    }

    public function getCartByUserId($userId): array|false
    {
        $statement = $this->pdo->prepare('SELECT * FROM carts where user_id= :userId');
        $statement->execute(['userId' => $userId]);
        return $statement->fetch();
    }

    public function getProductsFromCartByUserId(int $userId):array|false
    {
        $statement = $this->pdo->prepare("SELECT * FROM products 
                                                         JOIN cart_product 
                                                         ON products.id = cart_product.product_id
                                                         WHERE cart_id = :cardId");
        $statement->execute(['cardId'=> $userId]);
        return $statement->fetchAll();
    }
}