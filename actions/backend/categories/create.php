<?php

require __DIR__ . '/../../functions/auth.php';

if (!empty($_POST) && ($_POST['mode'] === 'login_user')) {
    $data = cleanData($_POST);

    $result = login($data);

    if (!empty($result['empty_email']) || !empty($result['empty_password']) || !empty($result['incorrect_login_password'])) {
        foreach ($result as $key => $value) {
            $_SESSION['any'][$key] = $massages['auth'][$key]['message'];
        }
        $redirect = '';
    } else {
        $_SESSION['user'] = $result;
        $_SESSION['success'] = $massages['auth']['success']['message'];
        $redirect = '/';
    }

    redirect($redirect);
}

$content = render($view);
