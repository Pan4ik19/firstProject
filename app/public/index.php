<?php

require_once './../View/Autoloader.php';

Autoloader::registate(dirname(__DIR__));

$app = new App();
$app->run();



