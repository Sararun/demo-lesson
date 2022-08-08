<?php

// хеширование пароля и вставка в базу
function register(array $data): string
{
    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
    $lastId = insert($data);

    return !empty($lastId) ? 'success_registry' : 'error_registry';
}
