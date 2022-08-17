<?php

return [
    [
        'url' => '#^$|^\?#',
        'view' => 'sites/index',
        'action' => 'sites/index',
    ],
    [
        'url' => '#^register?#i',
        'view' => 'auth/register',
        'action' => 'auth/register',
    ],
    [
        'url' => '#^login?#i',
        'view' => 'auth/login',
        'action' => 'auth/login',
    ],
    [
        'url' => '#^logout?#i',
        'view' => '',
        'action' => 'auth/logout',
    ],


    /** categories */
    [
        'url' => '#^admin/categories/create?#i',
        'view' => 'backend/categories/create',
        'action' => 'backend/categories/create',
    ],
    [
        'url' => '#^admin/categories/update?#i',
        'view' => 'backend/categories/update',
        'action' => 'backend/categories/update',
    ],
    [
        'url' => '#^admin/categories/delete?#i',
        'view' => '',
        'action' => 'backend/categories/delete',
    ],
    [
        'url' => '#^admin/categories?#i',
        'view' => 'backend/categories/index',
        'action' => 'backend/categories/index',
    ],
    /** products */
    [
        'url' => '#^admin/products/create?#i',
        'view' => 'backend/products/create',
        'action' => 'backend/products/create',
    ],
    [
        'url' => '#^admin/products/update?#i',
        'view' => 'backend/products/update',
        'action' => 'backend/products/update',
    ],
    [
        'url' => '#^admin/products/delete?#i',
        'view' => '',
        'action' => 'backend/products/delete',
    ],
    [
        'url' => '#^admin/products?#i',
        'view' => 'backend/products/index',
        'action' => 'backend/products/index',
    ],

    [
        'url' => '#^admin?#i',
        'view' => 'backend/sites/index',
        'action' => 'backend/sites/index',
    ],
];
