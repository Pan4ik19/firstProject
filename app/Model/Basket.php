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
    public function getProductFromBasketById(array $data): array|false
    {
        $statement = $this->pdo->prepare("SELECT * FROM cart_product 
                                                where cart_id= :cartId and 
                                                      product_id= :productId");
        $statement->execute(['cartId'=> $data['cartId'],'productId' =>$data['productId']]);
        return $statement->fetch();
    }
    private function isProductOnBasket(array $data):bool
    {
        $productFromBasket = $this->getProductFromBasketById($data);
        if($productFromBasket){
            return true;
        }
        return false;
    }

    public function addProduct(array $data) // $data = [productId,quantity,cartId]
    {
        $isProductFromBasket= $this->isProductOnBasket($data);
        if($isProductFromBasket){
            $statement = $this->pdo->prepare("UPDATE cart_product SET quantity =  quantity + :quantity 
                                                    WHERE cart_id = :cartId and 
                                                          cart_product.product_id = :productId");
            $statement->execute(['quantity'=>$data['quantity'],
                                 'cartId'=>$data['cartId'],
                                 'productId'=>$data['productId']
            ]);
        }else{
            $statement = $this->pdo->prepare("insert into cart_product(cart_id, product_id, quantity) 
                                                    values(:cartId,:productId,:quantity)");
            $statement->execute(['cartId' => $data['cartId'],
                'productId' => $data['productId'],
                'quantity' => $data['quantity']
            ]);
        }

    }

    public function getProductsFromBasket(int $userId)
    {
        $statement = $this->pdo->prepare("SELECT * FROM products 
                                                         JOIN cart_product 
                                                         ON products.id = cart_product.product_id
                                                         WHERE cart_id = :cardId");
        $statement->execute(['cardId'=> $userId]);
        return $statement->fetchAll();
    }
}