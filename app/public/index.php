<?php

use Controller\Autoloader;

require_once './../Controller/Autoloader.php';

Autoloader::registate(dirname(__DIR__));

$app = new App();
$app->run();



