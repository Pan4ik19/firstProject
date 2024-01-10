<?php

namespace Controller;

class Controller
{
    public function getUserId():int|null
    {
        session_start();
        if(isset($_SESSION['user_id']))
        {
            return $_SESSION['user_id'];
        }
        return null;
    }

    public function getLoginLocation()
    {
        header("Location:/login");
    }

    public function getMainLocation()
    {
        header("Location:/main");
    }
}