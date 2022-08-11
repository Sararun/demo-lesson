<?php

declare(strict_types=1); //Введение строгой типизации
error_reporting(-1);
session_start();
require __DIR__ . '/functions/function.php'; // Ввод исполняющего файла

$url = $_SERVER['REQUEST_URI'];
$parser = parse_url($url);
$url = trim($parser['path'], '/');

$routes = require __DIR__ . '/config/routes.php';

$view = '';
$action = '';

// цикл приравнивает значение к переменным отталкиваясь от регулярки
foreach ($routes as $route) {
    if (preg_match($route['url'], $url, $matches)) {
        $view = $route['view'];
        $action = $route['action'];
    }
}

/*  Если action не определён, то  выкидваем кастомную 404,
 это надо если человек захочет ввести несанкционированые данные*/

if (empty($action)) {
    http_response_code(404);
    require __DIR__ . '/views/404.php';
    die;
}
dump($action);
$massages = require __DIR__ . '/config/massages.php';
require __DIR__ . "/actions/{$action}.php";

if (!preg_match('#^backend#', $action)) {
    //require __DIR__ . '/views/layouts/default.php';
} else {
    require __DIR__ . '/views/layouts/admin.php';
}