<?php

require __DIR__ . '/../../../functions/products.php';

if (!empty($_POST) && ($_POST['mode'] === 'add_product')) {

    $data = cleanData($_POST);

    $nameError = validateProductData($data);

    $redirect = '/admin/products/create';
    if(!is_null($nameError)) {
        $_SESSION['error'] = $messages['products'][$nameError]['message'];
    } elseif (checkTableName('products', 'slug', getTranslate($data['title']))) {
        $_SESSION['error'] = $messages['products']['slug_busy']['message'];
    } elseif ($id = createProduct($data)) {
        $filePath = uploadFile($_FILES['thumbnail']);

        saveImage($id, $filePath);

        $_SESSION['success'] = $messages['add'];
        $redirect = '/admin/products';
    }
    redirect($redirect);

}

$categories = getCategories(true);

$content = render($view, [
    'categories' => $categories,
]);
