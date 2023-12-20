<?php

require_once './../Model/User.php';

class UserController
{
    private User $modelUser;
    private array $errors;

    public function __construct()
    {
        $this->modelUser=new User();
    }
    private function isValidate(string $email, string $password, string $name = NULL):bool
    {
        $pattern="^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";
        if (!preg_match ($pattern, $email))
        {
            $this->errors['email'] = "Error! Email is not valid.";
        }
        if (strlen($password) < 4) {
            $this->errors['password'] = "Password is not valid";
        }
        $flagName = $name ? true : false;
        if ($flagName)
        {
            $pattern = "/^[A-z]*$/";
            if (strlen($name) < 2 ){
                $this->errors['name'] = "Error! You didn't enter the Name.";
            }elseif (!preg_match ($pattern, $name)){
                $this->errors['name'] = "Error! You didn't enter the Name.";
            }
        }

        if(empty($this->errors))
        {
            if($flagName)
            {
                $dataDB = $this->modelUser->getOneByEmail($email);
                if(gettype($dataDB) === "array")
                {
                    $this->errors['email'] = "This email is used";
                }
            }
        }
        return empty($this->errors) ? true: false;
    }

    public function getErrors():array
    {
        return $this->errors;
    }

    public function registrate(array $data)
    {
        $flagValidate = $this->isValidate($data['email'] ?? '',$data['password'] ?? '',$data['name'] ?? '');
        if ($flagValidate)
        {
            $password = password_hash($data['password'],PASSWORD_DEFAULT);
            $this->modelUser->createOne($data['name'],$data['email'], $password);
            header('Location:/login');
        }else {
            $errors = $this->getErrors();
            require_once './../View/registrate.php';
        }
    }

    public function login($data)
    {
        $flagFound = false;
        $flagValidate = $this->isValidate($data['email'] ?? '',$data['password'] ?? '');
        if ($flagValidate)
        {
            $dataDB = $this->modelUser->getOneByEmail($data['email']);
            if (gettype($dataDB) === "array")
            {
                if (password_verify($data['password'], $dataDB['password']))
                {
                    session_start();
                    $_SESSION['user_id'] = $dataDB['id'];
                    header('Location:/main');
                    $flagFound=true;
                }
            }
        }
        if (!$flagFound)
        {
            $this->errors['not_found']='User is not found';
        }
        $errors = $this->getErrors();
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