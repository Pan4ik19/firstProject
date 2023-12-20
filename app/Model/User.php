<?php

class User
{
    private PDO $pdo;

    public function __construct()
    {
        require_once './../Model/storage.php';
        $this->pdo = $storagePdo;
    }

    public function getOneByEmail(string $email)
    {
        $statement = $this->pdo->prepare("Select * FROM users where email = :email");
        $statement->execute(['email' => $email]);
        return $statement->fetch();
    }

    public function createOne(string $name, string $email, string $password)
    {
        $statement = $this->pdo->prepare("insert into users(name, email, password) values(:name,:email,:password)");
        $statement->execute(['name' =>$name, 'email' => $email, 'password' =>$password ]);
    }
}