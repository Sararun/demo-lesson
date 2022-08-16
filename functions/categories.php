<?php

function getOneCategory(int $id): ?array
{
    $query = "SELECT * FROM `categories` WHERE id=:id LIMIT 1";
    $dbh = connect();
    $sth = $dbh->prepare($query);
    $sth->execute([':id' => $id]);
    $result = $sth->fetch();

    return ($result !== false) ? $result : null;
}

function validateCategoryData(array $data): ?string
{
    if (empty($data['name'])) {
        return 'empty_name';
    } elseif (mb_strlen($data['name']) > 100) {
        return 'big_name';
    }

    return null;
}

function createCategory(array $data): int
{
    $slug = getTranslate($data['name']);
    $params = ['slug' => $slug, 'name' => $data['name']];

    if (!empty($data['is_active'])) {
        $params['is_active'] = 1;
    }

    $lastId = insert('categories', $params);

    return $lastId;
}

function updateCategory(array $data): bool
{
    $slug = getTranslate($data['name']);
    $params = ['id' => $data['id'], 'slug' => $slug, 'name' => $data['name']];

    if (!empty($data['is_active'])) {
        $params['is_active'] = 1;
    } else {
        $params['is_active'] = 0;
    }

    $result = update('categories', $params);

    return $result;
}
