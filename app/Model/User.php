<?php

namespace Model;
class User extends Model
{
    public function getOneByEmail(string $email): array|false
    {
        $statement = $this->pdo->prepare("Select * FROM users where email = :email");
        $statement->execute(['email' => $email]);
        return $statement->fetch();
    }
    public function getOneById(int $userId): array|false
    {
        $statement = $this->pdo->prepare("Select * FROM users where id = :id");
        $statement->execute(['id' => $userId]);
        return $statement->fetch();
    }

    public function createOne(string $name, string $email, string $password)
    {
        $statement = $this->pdo->prepare("insert into users(name, email, password) values(:name,:email,:password)");
        $statement->execute(['name' =>$name, 'email' => $email, 'password' =>$password ]);
    }
}