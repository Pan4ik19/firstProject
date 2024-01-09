<?php

namespace Model;

class CartProduct extends Model
{

    public function addProduct(array $data): void // $data = [productId,quantity,cartId]
    {
        $isProductFromBasket = $this->getProductFromBasketById($data);
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

    public function getProductFromBasketById(array $data): array|false
    {
        $statement = $this->pdo->prepare("SELECT * FROM cart_product 
                                                where cart_id= :cartId and 
                                                      product_id= :productId");
        $statement->execute(['cartId'=> $data['cartId'],'productId' =>$data['productId']]);
        return $statement->fetch();
    }


}