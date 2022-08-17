<?php

require __DIR__ . '/../../../functions/categories.php';

if (!empty($_GET['id'])) {

    $id = cleanData($_GET['id']);

    $category = getOneCategory($id);

    if (empty($category)) {
        http_response_code(404);
        require __DIR__ . '/../../../views/404.php';
        die;
    }

    if (deleteCategory($id)) {
        $_SESSION['success'] = $messages['delete'];
    } else {
        $_SESSION['error'] = $messages['delete_error'];
    }

    redirect();
}
