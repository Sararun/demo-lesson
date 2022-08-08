<?php

// хеширование пароля и вставка в базу
function register(array $data): string
{
    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
    $lastId = insert($data);

    return !empty($lastId) ? 'success_registry' : 'error_registry';
}

function login(array $data): array
{
    $dbh = connect();
    $query = "SELECT * FROM users WHERE email=:email LIMIT 1";
    $sth = $dbh->prepare($query);
    $sth->execute([':email' => $data['email']]);
    $result = $sth->fetch();

    if (!empty($result) && password_verify($data['password'], $result['password'])) {
        $flag = true;
    } else {
        $flag = false;
    }

    return ($flag) ? $result : ['incorrect_login_password'] ;
}