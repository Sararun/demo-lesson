<?php

//подключить файл категории функциии

if (!empty($_POST) && ($_POST['mode'] === 'add_category')) {

    $category = cleanData($_POST);
    //сделать по аналогии как авторизация и регистрация
    //то есть переписать в функции которое добавлить в файл categories.php folder function

    $redirect = '/admin/categories/create';
    if (empty($category['name'])) {
        $_SESSION['error'] = $messages['categories']['empty_name']['message'];

    } elseif (mb_strlen($category['name']) > 100) {
        $_SESSION['error'] = $messages['categories']['big_name']['message'];
    } else {
        $slug = getTranslate($category['name']);
        $params = ['slug' => $slug, 'name' => $category['name']];

        if (!empty($category['is_active'])) {
            $params['is_active'] = 1;
        }

        if (insert('categories', $params)) {
            $_SESSION['success'] = $messages['add'];
            $redirect = '/admin/categories';
        }
    }
    dump($_SESSION['success']);
    redirect($redirect);
}

$content = render($view);
