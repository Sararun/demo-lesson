<?php

return [
    'auth' => [
        'empty_email' => [
            'key' => 'error',
            'message' => 'Заполните поле email.',
        ],
        'email_not_valid' => [
            'key' => 'error',
            'message' => 'Введите корректный email.',
        ],
        'email_taken' => [
            'key' => 'error',
            'message' => 'Такой email уже зарегистрирован.',
        ],
        'success_registry' => [
            'key' => 'success',
            'message' => 'Успешно зарегистрировались.',
        ],
        'success_login' => [
            'key' => 'success',
            'message' => 'Успешно авторизованы.',
        ],
        'error_registry' => [
            'key' => 'error',
            'message' => 'Ошибка регистрации.',
        ],
        'empty_user' => [
            'key' => 'error',
            'message' => 'Заполните поле имени',
        ],
        'username_not_valid'=>[
            'key' => 'error',
            'message' => 'Введите корректное имя пользователя',
        ],
        'username_short' => [
            'key' => 'error',
            'message' => 'Вы ввели короткое имя пользователя',
        ],
        'empty_password' => [
            'key' => 'error',
            'message' =>'Вы не заполнили поле для пароля',
        ],
        'short_password' => [
            'key' => 'error',
            'message' => 'Слишком короткий пароль',
        ],
        'is_not_number_password' => [
            'key' => 'error',
            'message' => 'Пароль не должен состоять только из цифр.',
        ],
        'is_not_sings_password' => [
            'key' => 'error',
            'message' => 'Пароль не должен состоять только из цифр.',
        ],
        'not_capitalized' => [
            'key' => 'error',
            'message' => 'Пароль должен содержать хотябы одну заглавную букву.',
        ],
        'incorrect_login_password' => [
            'key' => 'error',
            'message' => 'Email/Пароль введены не верно.',
        ],
    ],
];

