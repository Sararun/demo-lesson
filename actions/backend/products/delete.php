<?php

require __DIR__ . '/../../../functions/products.php';

if (!empty($_GET['id'])) {

    $id = cleanData($_GET['id']);

    $product = getOneProduct($id);

    if (empty($product)) {
        http_response_code(404);
        require __DIR__ . '/../../../views/404.php';
        die;
    }

    if (deleteProduct($id)) {
        $_SESSION['success'] = $messages['delete'];
    } else {
        $_SESSION['error'] = $messages['delete_error'];
    }

    redirect();
}
