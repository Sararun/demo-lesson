<?php
//подключить файл категории функциии

if (!empty($_POST) && ($_POST['mode'] === 'update_category')) {

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
        $params = ['id' => $category['id'], 'slug' => $slug, 'name' => $category['name']];

        if (!empty($category['is_active'])) {
            $params['is_active'] = 1;
        } else {
            $params['is_active'] = 0;
        }

        if (update('categories', $params)) {
            $_SESSION['success'] = $messages['update'];
            $redirect = '/admin/categories';
        }
    }

    redirect($redirect);
}

$id = $_GET['id'] ?? null;

if (empty($id)) {
    http_response_code(404);
    require __DIR__ . '/../../../views/404.php';
    die;
}

$query = "SELECT * FROM `categories` WHERE id=:id LIMIT 1";
$dbh = connect();
$sth = $dbh->prepare($query);
$sth->execute([':id' => $id]);
$category = $sth->fetch();

if (empty($category)) {
    http_response_code(404);
    require __DIR__ . '/../../../views/404.php';
    die;
}

$content = render($view, [
    'category' => $category,
]);