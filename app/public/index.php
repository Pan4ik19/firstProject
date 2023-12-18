<?php

$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

$pages =['/registrate'=>
             [   'GET'=>'./html/registrate.php',
                 'POST'=>'./handler/registrate.php'],
         '/login'=>
             [   'GET'=>'./html/login.php',
                 'POST'=>'./handler/login.php'],
         '/main'=>
             [   'GET'=>'./handler/main.php',
                 'POST'=>'./handler/main.php']
        ];




require_once $pages[$requestUri][$requestMethod] ?? './html/not_found.php';
//$getRequest= [];
//$postRequest=[];


//if ($requestUri === '/registrate')
//{
//    if($requestMethod === 'GET'){
//        require_once './html/registrate.php';
//    }elseif ($requestMethod ==='POST'){
//        require_once './handler/registrate.php';
//    }else{
//        echo 'такой $requestMethod не поддерживается';
//    }
//
//}elseif ($requestUri === '/login')
//{
//    if($requestMethod === 'GET'){
//        require_once './html/login.php';
//    }elseif ($requestMethod ==='POST'){
//        require_once './handler/login.php';
//    }else{
//        echo 'такой $requestMethod не поддерживается';
//    }
//}else
//{
//    require_once './html/not_found.php';
//}