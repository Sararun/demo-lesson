<?php

require __DIR__ . '/../../../functions/categories.php';

if (!empty($_POST) && ($_POST['mode'] === 'delete_category')) {

    $data = cleanData($_POST);
    $redirect = '/admin/categories/delete?id=' . $data['id'];

    returnTrueId($data['id']);

    if (returnTrueId($data['id'])) {

        deleteCategory($data);
    }


}