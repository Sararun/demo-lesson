<?php

function dump($data)
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
}

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

function render(string $path, array $data = [])
{
    if (is_array($data)) {
        extract($data);
    }

    $viewpath = __DIR__ . "/../views/{$path}.php";

    ob_start();
    if (!file_exists($viewpath)) {
        http_response_code(404);
        require __DIR__ . '/../views/4040.php';
        die;
    }

    require $viewpath;
    return ob_get_clean();
}

function redirect(string $http = ''): void
{
    if ($http) {
        $redirect = $http;
    } else {
        $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/';
    }

    header("Location: {$redirect}");
    die;
}

function cleanData($data)
{
    unset($data['mode']);

    if (is_array($data)) {
        foreach ($data as $k => $v) {
            $data[$k] = htmlspecialchars(strip_tags(trim($v)));
        }
    } else {
        $data = htmlspecialchars(strip_tags(trim($data)));
    }
    dump($data);die;
    return $data;
}
