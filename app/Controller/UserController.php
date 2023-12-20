<?php

class UserController
{
    private PDO $pdo;
    private array $errors;

    public function __construct()
    {
        $this->pdo=new \PDO("pgsql:host=db;dbname=postgres", "postgres", "postgres");
    }

    private function validateName(array $data)
    {
        $pattern = "/^[A-z]*$/";
        $error = NULL;
        $name = $data['name'] ?? '' ;
        if (strlen($name) < 2 ){
            $error = "Error! You didn't enter the Name.";
        }elseif (!preg_match ($pattern, $name)){
            $error = "Error! You didn't enter the Name.";
        }
        return $error;
    }

    private function validateEmail(array $data)
    {
        $error = NULL;
        $pattern="^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";
        $email= $data['email'];
        if (!preg_match ($pattern, $email))
        {
            $error = "Error! Email is not valid.";
        }

        return $error;
    }
    private function validatePassword(array $data)
    {
        $error = NULL;
        $password = $data['password'];
        if (strlen($password) < 4) {
            $error = "Password is not valid";
        }
        return $error;
    }
    public function registrate(array $data)
    {
        if($this->validateName($data) !== NULL){
            $errors['name'] = $this->validateName($data);
        }
        if($this->validateEmail($data) !== NULL){
            $errors['email'] = $this->validateEmail($data);
        }
        if($this->validatePassword($data) !== NULL){
            $errors['password'] = $this->validatePassword($data);
        }
        if (empty($errors))
        {
            $password = password_hash($data['password'],PASSWORD_DEFAULT);
            $statement = $this->pdo->prepare("insert into users(name, email, password) values(:name,:email,:password)");
            $statement->execute(['name' =>$data['name'], 'email' => $data['email'], 'password' =>$password ]);
            header('Location:/login');
        }
        require_once './../View/registrate.php';
    }

    public function login($data)
    {
        $errors=[];
        if($this->validateEmail($data) !== NULL){
            $errors['email'] = $this->validateEmail($data);
        }
        if($this->validatePassword($data) !== NULL){
            $errors['password'] = $this->validatePassword($data);
        }

        $flag = false;
        if (empty($errors))
        {
            //$pdo = new \PDO("pgsql:host=db;dbname=postgres", "postgres", "postgres");
            $statement = $this->pdo->prepare("Select * FROM users where email = :email");
            $statement->execute(['email' => $data['email']]);
            $dataDb = $statement->fetch();
            if (gettype($dataDb) === "array" && isset($data['password'] ))
            {
                if (password_verify($data['password'], $dataDb['password']))
                {
                    session_start();
                    $_SESSION['user_id'] = $dataDb['id'];
                    header('Location:/main');
                    $flag=true;
                }
            }
        }
        if (!$flag)
        {
            $errors['not_found']='User is not found';
        }
        require_once './../View/login.php';


    }

    public function logout()
    {
        session_start();
        unset($_SESSION['user_id']);
        header('Location: /login');
    }

    public function getRegistrate()
    {
        require_once './../View/registrate.php';
    }
    public function getLogin()
    {
        require_once './../View/login.php';
    }
}