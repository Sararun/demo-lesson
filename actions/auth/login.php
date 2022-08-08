<?php
require __DIR__ . '/../../functions/auth.php'; // логика логирования

//  Все возможные ошибки

if (!empty($_POST) && ($_POST['mode'] === 'login_user')) {
    $data = cleanData($_POST);

    $errors = [];
    if (empty($data['email'])) {
        $errors['empty_email'] = $massages['auth']['empty_email']['message'];
    } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email_not_valid'] = $massages['auth']['email_not_valid']['message'];
    }

