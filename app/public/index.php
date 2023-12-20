<?php
require_once './../Controller/UserController.php';
require_once  './../Controller/MainController.php';


$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];
//if($requestMethod === 'GET')
//{
//    switch ($requestUri){
//        case '/registrate':
//            $userController = new UserController();
//            $userController->getRegistrate();
//            break;
//        case '/login':
//            $userController = new UserController();
//            $userController->getLogin();
//            break;
//        case '/main':
//            $mainController = new MainController();
//            $products = $mainController->getProducts();
//            $mainController->getMain();
//
//            break;
//        default:
//            require_once './../View/not_found.php';
//    }
//}
//elseif($requestMethod === 'POST')
//{
//    switch ($requestUri){
//        case '/registrate':
//            $userController = new UserController();
//            $data = $userController->registrate($_POST);
//            break;
//        case '/login':
//            $userController = new UserController();
//            $data = $userController->login($_POST);
//            break;
//        case '/main':
//            $userController = new UserController();
//            $userController->logout();
//            break;
//        default:
//            require_once './../View/not_found.php';
//    }
//}

if($requestUri === '/registrate')
{
    switch ($requestMethod){
        case 'GET':
            $userController = new UserController();
            $userController->getRegistrate();
            break;
        case 'POST':
            $userController = new UserController();
            $userController->registrate($_POST);
            break;
        default:
            require_once './../View/not_found.php';
    }
}
elseif($requestUri === '/login')
{
    switch ($requestMethod){
        case 'GET':
            $userController = new UserController();
            $userController->getLogin();
            break;
        case 'POST':
            $userController = new UserController();
            $userController->login($_POST);
            break;
        default:
            require_once './../View/not_found.php';
    }
}elseif($requestUri === '/main')
{
    switch ($requestMethod){
        case 'GET':
            $mainController = new MainController();
            $mainController->getProducts();
            break;
        case 'POST':
            $userController = new UserController();
            $userController->logout();
            break;
        default:
            require_once './../View/not_found.php';
    }
}

