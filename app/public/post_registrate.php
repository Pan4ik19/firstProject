<?php

print_r($_GET);

$pdo = new PDO("pgsql:host=db;dbname=postgres", "testuser", "qwerty");

$name = $_GET['name'];
$email = $_GET['email'];
$password = $_GET['psw'];



$pdo->exec("insert into users(name, email, password) values('$name','$email','$password')");