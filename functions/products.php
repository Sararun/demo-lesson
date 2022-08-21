<?php

function getOneProduct(int $id): ?array
{
    $dbh = connect();
    $query = "SELECT * FROM `products` WHERE id=:id LIMIT 1";
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
    } elseif (empty($data['price'])) {
        return 'empty_price';
    } elseif (!preg_match('#^\d+$#', $data['price'])) {
        return 'not_number';
    } elseif (empty($data['quantity'])) {
        return 'empty_quantity';
    } elseif (!preg_match('#^\d+$#', $data['quantity'])) {
        return 'not_number';
    } elseif (empty($data['created_at'])) {
        return 'empty_date';
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
        'id' => $data['id'],
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

function saveImage(int $id, string $filePath): bool
{
    return insert('product_images', [
        'product_id' => $id,
        'thumbnail' => $filePath,
    ]);
}

function deleteProduct(int $id): bool
{
    if (delete('products', $id)) {
        deleteImage($id);

        return true;
    }

    return false;
}

function deleteImage(int $id): void
{
    $dbh = connect();
    $query = "DELETE FROM product_images WHERE product_id=:id";
    $sth = $dbh->prepare($query);
    $sth->execute([':id' => $id]);
}
