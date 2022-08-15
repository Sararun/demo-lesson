<?php
function create() {
    if (!empty($_POST) && ($_POST['mode'] === 'add_category')) {

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
            $params = ['slug' => $slug, 'name' => $category['name']];

            if (!empty($category['is_active'])) {
                $params['is_active'] = 1;
            }

            if (insert('categories', $params)) {
                $_SESSION['success'] = $messages['add'];
                $redirect = '/admin/categories';
            }
        }
        redirect($redirect);
    }

    $content = render($view);
}

function update(string $tableName, array $data): bool
{
    $columns = [];
    $values = [':id' => $data['id']];
    foreach ($data as $key => $value) {
        if ($key == 'id') {
            continue;
        }
        $columns[] = "{$key}=:{$key}";
        $values[":{$key}"] = $value;
    }

    $query = "UPDATE `{$tableName}` SET "
        . implode(', ', $columns)
        . " WHERE `id`=:id LIMIT 1";

    $dbh = connect();
    $sth = $dbh->prepare($query);
    $sth->execute($values);
    $result = $sth->rowCount();

    return (bool)$result;
}