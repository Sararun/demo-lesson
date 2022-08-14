<?php

require __DIR__ . '/../../../functions/auth.php';

if (!empty($_POST) && ($_POST['mode'] === 'add_category')) {


    $category = cleanData($_POST);

    //сделать по аналогии как авторизация и регистрация
    //то есть переписать в функции которое добавлить в файл categories.php folder function

    $redirect = 'admin/categories/create';

    //  Если имя категории не введено
    if (empty($category['name'])) {
        $_SESSION['error'] = $messages['categories']['empty_name']['message'];

        //  Если имя категории длиннее 100 символов
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

}
$content = render($view);
