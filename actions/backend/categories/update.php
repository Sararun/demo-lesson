<?php

require __DIR__ . '/../../../functions/categories.php';

if (!empty($_POST) && ($_POST['mode'] === 'update_category')) {

    $data = cleanData($_POST);

    $nameError = validateCategoryData($data);

    $redirect = '/admin/categories/update?id=' . $data['id'];

    if (!is_null($nameError)) {
        $_SESSION['error'] = $messages['categories'][$nameError]['message'];
    } elseif (updateCategory($data)) {
        $_SESSION['success'] = $messages['update'];
        $redirect = '/admin/categories';
    }

    redirect($redirect);
}

$id = $_GET['id'] ?? null;

if (empty($id)) {
    http_response_code(404);
    require __DIR__ . '/../../../views/404.php';
    die;
}

$category = getOneCategory($id);

if (empty($category)) {
    http_response_code(404);
    require __DIR__ . '/../../../views/404.php';
    die;
}

$content = render($view, [
    'category' => $category,
]);