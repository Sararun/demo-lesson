<?php

function getOneProduct(int $id): ?array
{
    $query = "SELECT * FROM `products` WHERE id=:id LIMIT 1";
    $dbh = connect();
    $sth = $dbh->prepare($query);
    $sth->execute([':id' => $id]);
    $result = $sth->fetch();

    return ($result !== false) ? $result : null;
}

function getProducts(): ?array
{
    $dbh = connect();
    $query = "SELECT * FROM products ORDER BY id DESC";
    $sth = $dbh->prepare($query);
    $sth->execute();
    $result = $sth->fetchAll();

    return ($result !== false) ? $result : null;
}

function validateProductData(array $data): ?string
{
    if (empty($data['title'])) {
        return 'empty_name';
    } elseif (mb_strlen($data['title']) > 100) {
        return 'big_name';
    }

    return null;
}

function createProduct(array $data): int
{
    $slug = getTranslate($data['title']);
    $params = [
        'category_id' => $data['category_id'],
        'slug' => $slug,
        'title' => $data['title'],
        'content' => $data['content'],
        'price' => $data['price'],
        'quantity' => $data['quantity'],
        'created_at' => $data['created_at'],
        'updated_at' => $data['created_at'],
    ];

    if (!empty($data['is_active'])) {
        $params['is_active'] = 1;
    }

    $lastId = insert('products', $params);

    return $lastId;
}

function updateProduct(array $data): bool
{
    $slug = getTranslate($data['title']);
    $params = [
        'category_id' => $data['category_id'],
        'slug' => $slug,
        'title' => $data['title'],
        'content' => $data['content'],
        'price' => $data['price'],
        'quantity' => $data['quantity'],
        'updated_at' => $data['created_at'],
    ];

    if (!empty($data['is_active'])) {
        $params['is_active'] = 1;
    } else {
        $params['is_active'] = 0;
    }

    $result = update('products', $params);

    return $result;
}

function deleteProduct(int $id): bool
{
    $result = delete('products', $id);

    return $result;
}
