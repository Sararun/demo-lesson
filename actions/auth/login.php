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

    if (empty($data['password'])) {
        $errors['empty_password'] = $massages['auth']['empty_password']['message'];
    }

    if (!empty($errors)) {
        $_SESSION['any'] = $errors;
    } else {
        $result = login($data);
        if (!empty($result[0]) && $result[0] === 'incorrect_login_password') {
            $_SESSION['error'] = $massages['auth'][$result[0]]['message'];
        } else {
            foreach ($result as $key => $value) {
                if ($key != 'password') {
                    $_SESSION['user'][$key] = $value;
                }
            }
            $_SESSION['success'] = $massages['auth']['success_login']['message'];
            redirect('/');
        }
    }

    redirect();
}

$content = render($view, []);