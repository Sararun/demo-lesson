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
            "mysql:host=localhost;dbname=db-shop-lesson;charset=utf8",
            "root",
            "root", [
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

function insert(string $tableName, array $data): int
{
    $fields = implode(', ', array_keys($data));
    $placeholders = str_repeat('?, ', count($data) - 1) . '?';

    $dbh = connect();
    $query = "INSERT INTO `{$tableName}` ({$fields}) VALUE ({$placeholders})";

    $sth = $dbh->prepare($query);
    $sth->execute(array_values($data));

    return (int)$dbh->lastInsertId();
}

function update(string $tableName, array $data): bool
{
    $columns = [];
    $values = [':id' => $data['id']];
    foreach ($data as $key => $value) {
        if ($key == 'id') {
            continue;
        }
        $columns[] = "{$key}=:{$key}";
        $values[":{$key}"] = $value;
    }

    $query = "UPDATE `{$tableName}` SET "
        . implode(', ', $columns)
        . " WHERE `id`=:id LIMIT 1";

    $dbh = connect();
    $sth = $dbh->prepare($query);
    $sth->execute($values);
    $result = $sth->rowCount();

    return (bool)$result;
}

function render(string $path, array $data = [])
{
    if (is_array($data)) {
        extract($data);
    }
    $viewPath = __DIR__ . "/../views/{$path}.php";
    ob_start();

    if (!file_exists($viewPath)) {
        http_response_code(404);
        require __DIR__ . '/../views/404.php';
        die;
    }
    require $viewPath;

    return ob_get_clean();
}

//редирект
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

    return $data;
}

function isEmail(string $email): bool
{
    return (bool)filter_var($email, FILTER_VALIDATE_EMAIL);
}

function checkTableName(string $tableName, string $column, string $value): bool
{
    $dbh = connect();
    $query = "SELECT id FROM {$tableName} WHERE {$column}=:{$column} LIMIT 1";
    $sth = $dbh->prepare($query);
    $sth->execute([":{$column}" => $value]);
    $result = $sth->rowCount();

    return (bool)$result;
}


//транслитерация
function rusTranslit($str)
{
    $str = mb_strtolower($str);

    $arr = [
        'а' => 'a', 'б' => 'b', 'в' => 'v',
        'г' => 'g', 'д' => 'd', 'е' => 'e',
        'ё' => 'e', 'ж' => 'zh', 'з' => 'z',
        'и' => 'i', 'й' => 'y', 'к' => 'k',
        'л' => 'l', 'м' => 'm', 'н' => 'n',
        'о' => 'o', 'п' => 'p', 'р' => 'r',
        'с' => 's', 'т' => 't', 'у' => 'u',
        'ф' => 'f', 'х' => 'h', 'ц' => 'c',
        'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch',
        'ь' => '', 'ы' => 'y', 'ъ' => '',
        'э' => 'e', 'ю' => 'yu', 'я' => 'ya',
        '(' => '', ')' => '', '\'' => '',
        '"' => '', '.' => '', '+' => '',
        '[' => '', ']' => '',
    ];
    return strtr($str, $arr);
}

function getTranslate($str)
{
    //переводит в транслит
    $str = rusTranslit($str);
    //заменяет все ненужное нам на "-"
    $str = preg_replace('~[^-a-z0-9_]+~u', '-', $str);
    //удаляет начальные и конечные '-'
    $str = trim($str, '-');
    return $str;
}
