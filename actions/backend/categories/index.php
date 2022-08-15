<?php

//подключить файл категории функциии

$dbh = connect();
$query = "SELECT * FROM `categories` ORDER BY id DESC";
$sth = $dbh->prepare($query);
$sth->execute();
$categories = $sth->fetchAll();

$content = render($view, [
    'categories' => $categories,
]);

