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



    [
        'url' => '#^admin/categories/create?#i',
        'view' => 'backend/categories/create',
        'action' => 'backend/categories/create',
    ],
    [
        'url' => '#^admin/categories?#i',
        'view' => 'backend/categories/index',
        'action' => 'backend/categories/index',
    ],
    [
        'url' => '#^admin/categories/update?#i',
        'view' => 'backend/categories/update',
        'action' => 'backend/categories/update',
    ],
    [
        'url' => '#^admin?#i',
        'view' => 'backend/sites/index',
        'action' => 'backend/sites/index',
    ],

];
