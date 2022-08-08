<?php

declare(strict_types = 1);
error_reporting(-1);
session_start();
require __DIR__ . 'functions/function.php'; //Контроллер

$url = $_SERVER['REQUEST_URI'];
$parser = parse_url($url);
$url = trim($parser['path'], '/');

$routes = [
    [
        'url' => '#^$|^\?#',
        'view' => 'sites/index',
        'action' => 'sites/index',
    ],
    [
        'url' => '#^register?#',
        'view' => 'auth/register',
        'action' => 'auth/register',
    ],
    [
        'url' => '#^login?#i',
        'view' => 'auth/login',
        'action' => 'auth/login',
    ]
];

$view = '';
$action = '';

// цикл приравнивает значение к переменным отталкиваясь от регулярки
foreach ($routes as $route) {
    if (preg_match($route['url'], $url, $matches)) {
        $view = $route['view'];
        $action = $route['action'];
    }
}