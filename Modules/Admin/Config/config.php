<?php

return [
    'name' => 'Admin',
    'domain' => env('ADMIN_DOMAIN', 'http://team.localhost'),
    'prefix' => env('ADMIN_PREFIX', '/'),
    'lists' => [
        [
            'title' => __(' Ads '),
            'model' => '\App\Models\Ad',
            'icon' => 'ion ion-ios-monitor',
            'route' => 'user.ad.get',
            'bg' => 'bg-info',
        ],
        [
            'title' => __(' Users '),
            'model' => '\App\Models\MainUser',
            'icon' => 'ion ion-person-add',
            'route' => 'admin.users.list',
            'bg' => 'bg-success',
        ],
        [
            'title' => __(' Payments '),
            'model' => '\App\Models\Payment\Payment',
            'icon' => 'ion ion-bag',
            'route' => 'admin.payments.list',
            'bg' => 'bg-warning',
        ],
        [
            'title' => __(' Categories '),
            'model' => '\App\Models\Category\Category',
            'icon' => 'ion ion-bag',
            'route' => 'admin.category.list',
            'bg' => 'bg-danger',
        ],
    ],
    'roles' => [
        'super-admin' => [
            '*', // all permissions
        ],
        'admin' => [
            '!delete user', //  ! cannot do action
            '!create admin',
            '!update admin',
            '!delete admin',
            '!access-management',
        ],
        'writer' => [
            'write article'
        ],
        'support' => [
            'contact user',
        ],
    ],
    'permissions' => [
        'create user',
        'read user',
        'update user',
        'delete user',
        'create ad',
        'read ad',
        'update ad',
        'delete ad',
        'write article',
        'contact user',
        'access-management',
        'activity-log-management',
        'create admin',
        'read admin',
        'update admin',
        'delete admin',
        'create payment',
        'read payment',
        'update payment',
        'delete payment',
    ]
];
