<?php
$DB_CONNECTION='pgsql';
$DB_HOST='db';
$DB_PORT='5432';
$DB_DATABASE='postgres';
$DB_USERNAME='postgres';
$DB_PASSWORD='postgres';

$array = ['connection'=>$DB_CONNECTION,'host'=>$DB_HOST,'dbname'=>$DB_DATABASE,
    'username'=>$DB_USERNAME,'password'=>$DB_PASSWORD];

$storagePdo = new \PDO("{$array['connection']}:host={$array['host']};dbname={$array['dbname']}",
    "{$array['username']}", "{$array['password']}");