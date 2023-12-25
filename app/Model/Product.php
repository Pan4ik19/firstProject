<?php

namespace Model;
class Product extends Model
{
    public function getALL():array|false
    {
        $statement = $this->pdo->query("SELECT * FROM products");
        return $statement->fetchAll();
    }

    public function getOneByID($id):array|false
    {
        $statement = $this->pdo->query("SELECT id FROM products where id = :id");
        $statement->execute(['id' => $id]);
        return $statement->fetch();
    }
}