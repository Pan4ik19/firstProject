<?php

namespace registration;
class User
{
    private string $name;
    private  string$email;
    private string $password;


    public function __construct( string $name, string $email, string $password)
    {
        $this -> name = $name;
        $this -> email = $email;
        $this -> password = password_hash($password,PASSWORD_DEFAULT);
    }

    public function getName():string
    {
        return $this->name;
    }

    public function getEmail():string
    {
        return $this->email;
    }

    public function getPassword():string
    {
        return $this->password;
    }
}

class Validate
{
    private array $errors = [];

    public function getErrors():array
    {
        return $this->errors;
    }

    public function validateName( string $name):string
    {
        $str = strlen($name);
        $pattern = "/^[a-zA-z]*$/";
        if ($str == 0 && $str < 2 ){
            $this->errors['name'] = "Error! You didn't enter the Name.";
        }elseif (!preg_match ($pattern, $name)){
            $this->errors['name'] = "Error! You didn't enter the Name.";
        }
        return $name;

    }

    public function validateEmail( string $email):string
    {
        $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";
        if (!preg_match ($pattern, $email)){
            $this->errors['email'] = "Error! Email is not valid.";
        }

        return $email;
    }

    public function validatePassword( string $password):string
    {
        $len = strlen($password);
        if ($len < 4) {
            $this->errors['password'] = "Password is not valid";
            return $password;
        }
        return $password;
    }



}

class Registrate
{
    private Validate $validateObject;
    private User $userObject;

    public function __construct(User $user, Validate $validate)
    {
        $this->validateObject=$validate;
        $this->userObject=$user;
    }
    public function getValidateObject(): Validate
    {
        return $this->validateObject;
    }

    public function getUserObject(): User
    {
        return $this->userObject;
    }

    public function addUserToDataBase():bool
    {
        if (empty($this->validateObject->getErrors()))
        {
            $pdo = new \PDO("pgsql:host=db;dbname=postgres", "postgres", "postgres");
            $statement = $pdo->prepare("insert into users(name, email, password) values(:name,:email,:password)");
            $statement->execute(['name' =>$this->userObject->getName(), 'email' => $this->userObject->getEmail(), 'password' => $this->userObject->getPassword()]);
            return true;
        }
        return false;
    }
}




$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';


$validate = new Validate();
$user = new User($validate->validateName($name), $validate->validateEmail($email), $validate->validatePassword($password));
$registrate = new Registrate($user,$validate);
$flag = $registrate->addUserToDataBase();

if($flag){

    header('Location:/login');
}else{
    require_once './html/registrate.php';
}
?>













