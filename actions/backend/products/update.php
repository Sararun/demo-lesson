<?php

require __DIR__ . '/../../../functions/products.php';

if (!empty($_POST) && ($_POST['mode'] === 'update_product')) {

    $data = cleanData($_POST);

    //$nameError = validateCategoryData($data);

    $redirect = '/admin/products/update?id=' . $data['id'];

    if (updateCategory($data)) {
        $_SESSION['success'] = $messages['update'];
        $redirect = '/admin/products';
    }

    redirect($redirect);
}

$id = $_GET['id'] ?? null;

if (empty($id)) {
    http_response_code(404);
    require __DIR__ . '/../../../views/404.php';
    die;
}

$product = getOneProduct($id);

if (empty($product)) {
    http_response_code(404);
    require __DIR__ . '/../../../views/404.php';
    die;
}

$categories = getCategories(true);

$content = render($view, [
    'product' => $product,
    'categories' => $categories,
]);