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

function insert(array $data): int
{
    $fields = implode(', ', array_keys($data));
    $placeholders = str_repeat('?, ', count($data) - 1) . '?';
    $dbh = connect();
    $query = "INSERT INTO users ({$fields}) VALUE ({$placeholders})";
    $sth = $dbh->prepare($query);
    $sth->execute(array_values($data));

    return (int)$dbh->lastInsertId();
}