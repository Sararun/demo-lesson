<?php

require __DIR__ . '/../../../functions/products.php';

if (!empty($_POST) && ($_POST['mode'] === 'add_product')) {

    $data = cleanData($_POST);

    $nameError = validateProductData($data);

    $redirect = '/admin/products/create';

    if (createProduct($data)) {
        $_SESSION['success'] = $messages['add'];
        $redirect = '/admin/products';
    }

    redirect($redirect);
}

$categories = getCategories(true);

$content = render($view, [
    'categories' => $categories,
]);
