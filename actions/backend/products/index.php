<?php

//подключить файл категории функциии

$dbh = connect();
$query = "SELECT * FROM `products` ORDER BY id DESC";
$sth = $dbh->prepare($query);
$sth->execute();
$products = $sth->fetchAll();

foreach ($products as $key => $value) {

    $query = "SELECT * FROM product_images WHERE product_id=:id";
    $sth = $dbh->prepare($query);
    $sth->execute([':id' => $value['id']]);
    $result = $sth->fetchAll();
    $products[$key]['images'] = $result;
}

$content = render($view, [
    'products' => $products,
]);