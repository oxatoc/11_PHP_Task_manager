<?php

use Oxatoc\Taskmanager\RouteClass;

spl_autoload_register( function ($class_name){
    $file = __DIR__.'/../app/'.$class_name.'.php';
    $file = str_replace('\\', '/', $file);
    require_once $file;
});

/* Инциализация сессии */
session_start();

/* Включение вывода ошибок пользователю */
ini_set('display_errors', 1);

/* Вызов маршрутизатора */
RouteClass::start();

