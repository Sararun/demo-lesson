<?php

require __DIR__ . '/../../functions/auth.php';

if (!empty($_POST) && ($_POST['mode'] === 'add_category')) {

    $category = cleanData($_POST);

    //сделать проверку на пустоту name
    //сделать проверку на кол-во символов не более 100
    //вывести сообщения об ошибках на клиента


    $slug = getTranslate($category['name']);
    $params = ['slug' => $slug, 'name' => $category['name']];

    if (empty($category['name'])) {
        return 'empty_name';
    }

    if (count($category['name']) >100) {
        return 'overflow_input';
    }

    if (!empty($category['is_active'])) {
        $params['is_active'] = 1;
    }

    if (insert('categories', $params)) {
        $_SESSION['success'] = $massages['add'];
        redirect('/admin/categories');
    }
}
$content = render($view);
