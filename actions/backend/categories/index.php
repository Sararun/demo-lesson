<?php

require __DIR__ . '/../../../functions/categories.php';

$categories = getCategories();

$content = render($view, [
    'categories' => $categories,
]);