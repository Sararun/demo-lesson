<?php

function connect(): \PDO
{
    try {
        static $dbh = null;

        if (!is_null($dbh)) {
            return $dbh;
        }
        $dbh = new \PDO(
            'mysql:host=localhost;dbname=db-shop-lesson;charset=utf8',
            'root',
            'root',
            [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
            ]
        );
        return $dbh;
    } catch (\PDOException $e) {
        die ("Ошибка подключения к бд {$e->getMessage()}");
    }
}