<?php

require __DIR__ . '/../../../functions/categories.php';

if (!empty($_POST) && ($_POST['mode'] === 'add_category')) {

    $data = cleanData($_POST);

    $nameError = validateCategoryData($data);

    $redirect = '/admin/categories/create';

    if (!is_null($nameError)) {
        $_SESSION['error'] = $messages['categories'][$nameError]['message'];
    } elseif (checkTableName('categories', 'slug', getTranslate($data['name']))) {
        $_SESSION['error'] = $messages['categories']['slug_busy']['message'];
    } elseif (createCategory($data)) {
        $_SESSION['success'] = $messages['add'];
        $redirect = '/admin/categories';
    }

    redirect($redirect);
}

$content = render($view);
