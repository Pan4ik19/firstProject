<?php

use Controller\BasketController;
use Controller\MainController;
use Controller\UserController;

class App
{
    private array $routes=[
        '/registrate'=>[
            'GET'=>[
                'class'=> UserController::class,
                'method'=> 'getRegistrate',
            ],
            'POST'=>[
                'class'=> UserController::class,
                'method'=> 'registrate',
            ]
        ],
        '/login'=>[
            'GET'=>[
                'class'=> UserController::class,
                'method'=> 'getLogin',
            ],
            'POST'=>[
                'class'=> UserController::class,
                'method'=> 'login',
            ]
        ],
        '/logout'=>[
            'GET'=>[
                'class'=> MainController::class,
                'method'=> 'logout',
            ],
            'POST'=>[
                'class'=> MainController::class,
                'method'=> 'logout',
            ]
        ],
        '/main'=>[
            'GET'=>[
                'class'=> MainController::class,
                'method'=> 'getProducts',
            ],
            'POST'=>[
                'class'=> MainController::class,
                'method'=> 'logout',
            ]
        ],
        '/addProduct'=>[
            'GET'=>[
                'class'=> MainController::class,
                'method'=> 'getBasket',
            ],
            'POST'=>[
                'class'=> MainController::class,
                'method'=> 'addProductInBasket',
            ]
        ],
        '/basket'=>[
            'GET'=>[
                'class'=> MainController::class,
                'method'=> 'getBasket',
            ],
            'POST'=>[
                'class'=> MainController::class,
                'method'=> 'getBasket',
            ]
        ]
    ];
    public function run()
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        if(isset($this->routes[$requestUri]))
        {
            $routeMethods = $this->routes[$requestUri];
            $requestMethod = $_SERVER['REQUEST_METHOD'];
            if(isset($routeMethods[$requestMethod]))
            {
                $handler = $routeMethods[$requestMethod];
                $class = $handler['class'];
                $method = $handler['method'];
                $obj = new $class();
                $obj -> $method($_POST);
            }
            else{
                echo "Метод $requestMethod не поддерживается для $requestUri" ;
            }
        }else{
            require_once './../View/not_found.php';
        }
    }
}