<?php

//подключить файл категории функциии

$dbh = connect();
$query = "SELECT * FROM `products` ORDER BY id DESC";
$sth = $dbh->prepare($query);
$sth->execute();
$products = $sth->fetchAll();

$content = render($view, [
    'products' => $products,
]);