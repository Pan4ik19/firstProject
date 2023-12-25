<?php

namespace Controller;


use Model\User;

class UserController
{
    private User $modelUser;

    public function __construct()
    {
        $this->modelUser = new User();
    }

    public function registrate(array $data)
    {
        $errors=$this->validateRegistrate($data);
        if (empty($errors))
        {
            $password = password_hash($data['password'],PASSWORD_DEFAULT);
            $this->modelUser->createOne($data['name'],$data['email'], $password);
            header('Location:/login');
        }else {
            require_once './../View/registrate.php';
        }
    }

    public function login($data)
    {
        $flagFound = false;
        $errors = $this->validateLogin($data);
        if (empty($errors))
        {
            $dataDB = $this->modelUser->getOneByEmail($data['email']);
            if ($dataDB)
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
            $errors['not_found']='User is not found';
        }
        require_once './../View/login.php';
    }

    private function validateLogin(array $data):array
    {
        $errors =[];
        $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";
        if (!preg_match($pattern, $data['email'] ))
        {
            $errors['email'] = "Error! Email is not valid.";
        }
        if (strlen($data['password'] < 4))
        {
            $errors['password'] = "Error! Password is not valid.";;
        }
        return $errors;
    }

    private function validateRegistrate(array $data):array
    {
        $errors = $this->validateLogin($data);
        $pattern = "/^[A-z]*$/";
        if (strlen($data['name']) < 2 ){
            $errors['name'] = "Error! You didn't enter the Name.";
        }elseif (!preg_match ($pattern, $data['name'])){
            $errors['name'] = "Error! You didn't enter the Name.";
        }
        if (empty($errors['email']))
        {
            $dataDB = $this->modelUser->getOneByEmail($data['email']);
            if(!empty($dataDB))
            {
                $errors['email'] = "This email is used";
            }
        }
        return $errors;
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