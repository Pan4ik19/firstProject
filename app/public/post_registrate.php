<?php

print_r($_POST);




class UserRegistration
{
    private $name;
    private $email;
    private $password;

    public function __construct($name, $email, $password)
    {
        $this -> name = $this->validateName($name);
        $this -> email = $this->validateEmail($email);
        $this -> password = $this->validatePassword($password);
    }


    public function getName()
    {
        return $this->name;
    }


    public function getEmail()
    {
        return $this->email;
    }


    public function getPassword()
    {
        return $this->password;
    }


    public function validateName($name)
    {
        $str = strlen($name);
        $pattern = "/^[a-zA-z]*$/";
        $flag = 0;
        if ($str == 0 && $str < 2 ){
            echo "Error! You didn't enter the Name.";
            $flag = 1;
        }elseif (!preg_match ($pattern, $name)){
            echo "Error! You didn't enter the Name.";
        }else {
            return $name;
        }


    }

    public function validateEmail($email)
    {
        $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";
        if (!preg_match ($pattern, $email)){
            echo "Email is not valid.";
        } else {
            return $email;
        }
    }

    public function validatePassword($password)
    {
        $len = strlen($password);
        if ($len < 4)
        {
            echo "Password is not valid";
        } else {
            return $password;
        }
    }


}
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['psw'];

$user = new UserRegistration($name, $email, $password);

if ($user->getName() !== Null  && $user->getEmail() !== Null  && $user->getPassword() !== Null)
{
    $pdo = new PDO("pgsql:host=db;dbname=postgres", "testuser", "qwerty");
    $name = $user->getName();
    $email = $user->getEmail();
    $password = $user->getPassword();
    $pdo->exec("insert into users(name, email, password) values('$name','$email','$password')");
    echo "Nice";
}






