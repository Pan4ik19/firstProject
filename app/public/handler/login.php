<?php
class User
{
    private string $name;
    private  string$email;
    private string $password;


    public function __construct( string $name, string $email, string $password)
    {
        $this -> name = $name;
        $this -> email = $email;
        $this -> password = $password;
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
        $pattern = "/^[A-z]*$/";
        if ( $str < 2 ){
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

class Login
{
    private User $userObject;
    private Validate $validateObject;

    public function __construct(User $user,Validate $validate )
    {
        $this->userObject=$user;
        $this->validateObject=$validate;
    }

    public function getUserObject(): User
    {
        return $this->userObject;
    }

    public function getValidateObject(): Validate
    {
        return $this->validateObject;
    }

    public function getUserFromDataBase(string $email):mixed
    {
        if (empty($this->validateObject->getErrors()))
        {
            $pdo = new \PDO("pgsql:host=db;dbname=postgres", "postgres", "postgres");
            $statement = $pdo->prepare("Select * FROM users where email = :email");
            $statement->execute(['email' => $email]);
            return $statement->fetch();

        }else return [];
    }

//    public function sessionStart(string $password, array $data)
//    {
//
//    }


}

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

$validate = new Validate();
$user1 = new User('', $validate->validateEmail($email),$validate->validatePassword($password));
$login1 = new Login($user1,$validate);

$data = $login1->getUserFromDataBase($login1->getUserObject()->getEmail());

$loginFlag =false;
if (gettype($data)==="array" && isset($data['password']))
{
    if (password_verify($login1->getUserObject()->getPassword(), $data['password']))
    {
        session_start();
        $_SESSION['user_id'] = $data['id'];
        header('Location:/main');
        $loginFlag=true;
    }
}else{
    require_once './html/login.php';
}




