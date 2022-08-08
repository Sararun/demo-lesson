<?php

require __DIR__ . '/../../functions/auth.php';

if (!empty($_POST) && ($_POST['mode'] === 'add_user')) {
    $data = cleanData($_POST);

    $errors = validateUserData($data);

    if ($errors) {
        foreach ($errors as $key => $value) {
            $msgArray = $massages['auth'][$value];
            $_SESSION['any'][] = $msgArray['message'];
        }
    } else {
        $result = register($data);
        $message = $massages['auth'][$result];
        $_SESSION[$message['key']] = $message['message'];
    }
    redirect();
}
$content = render($view, []);
