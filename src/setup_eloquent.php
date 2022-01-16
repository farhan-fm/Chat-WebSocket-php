<?php

use \Illuminate\Database\Capsule\Manager as Capsule;
use \Illuminate\Events\Dispatcher;
use \Illuminate\Container\Container;

date_default_timezone_set('Asia/Tehran');

$container = new Container();
$capsule = new Capsule();

$capsule->addConnection([
    'driver' => 'mysql',
    'host' => 'localhost',
    'databasee' => 'php_chat',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
    'collation' => 'utf8_general_ci',
    'prefix' => '',
]);

$capsule->setEventDispatcher(new Dispatcher($container));
$capsule->setAsGlobal();
$capsule->bootEloquent();

?>
