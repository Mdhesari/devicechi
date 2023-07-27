<?php

return [
    'name' => 'Admin',
    'domain' => env('ADMIN_DOMAIN', 'http://team.localhost'),
    'prefix' => env('ADMIN_PREFIX', '/'),
    'layout' => 'admin::app',
    'max_upload_size' => env('MAX_UPLOAD_SIZE_IN_KB', 99000), // KB
    'auth_navs' => [
        [
            'title' => __(' Home Page '),
            'route' => 'user.ad.home',
            'params' => [],
        ],
        [
            'title' => __(' All Ads '),
            'route' => 'user.ad.get',
            'params' => [],
        ],
        [
            'title' => __(' Contact us '),
            'route' => 'contact-us',
            'params' => [],
        ],
        [
            'title' => __(' Rules '),
            'route' => 'rules',
            'params' => [],
        ]
    ],
    'guest_navs' => [
        [
            'title' => __(' Home Page '),
            'route' => 'user.home',
            'params' => [],
        ],
        [
            'title' => __(' All Ads '),
            'route' => 'user.ad.get',
            'params' => [],
        ],
        [
            'title' => __(' Contact us '),
            'route' => 'contact-us',
            'params' => [],
        ],
        [
            'title' => __(' Rules '),
            'route' => 'rules',
            'params' => [],
        ]
    ],
    'footer_navs' => [
        [
            'title' => __(' Home Page '),
            'route' => 'user.home',
            'params' => [],
        ],
        [
            'title' => __(' Contact us '),
            'route' => 'contact-us',
            'params' => [],
        ],
        [
            'title' => __(' Rules '),
            'route' => 'rules',
            'params' => [],
        ],
    ],
    'lists' => [
        [
            'title' => __(' Ads '),
            'model' => '\App\Models\Ad',
            'icon' => 'ion ion-ios-monitor',
            'route' => 'admin.ads.list',
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
            'title' => __(' Brands '),
            'model' => '\App\Models\PhoneBrand',
            'icon' => 'ion ion-bag',
            'route' => 'admin.brands.list',
            'bg' => 'bg-danger',
        ],
    ],
    'roles' => [
        'super-admin' => [
            '*', // all permissions
        ],
        'admin' => [
            //  ! cannot do action
            '!delete admin',
            '!access-management',
            '!activity-log-management',
            '!create payment',
            '!read payment',
            '!delete payment',
            '!create media',
            '!read media',
            '!delete media',
        ],
        'writer' => [
            'write article',
            'create pages',
            'read pages',
            'delete pages',
            'create posts',
            'read posts',
            'delete posts',
            'delete user',
            'create ad',
            'read ad',
            'delete ad',
            'contact user',
        ],
        'support' => [
            'contact user',
        ],
    ],
    'permissions' => [
        'create user',
        'read user',
        'delete user',
        'create ad',
        'read ad',
        'delete ad',
        'write article',
        'contact user',
        'access-management',
        'activity-log-management',
        'create admin',
        'read admin',
        'delete admin',
        'create payment',
        'read payment',
        'delete payment',
        'create media',
        'read media',
        'delete media',
        'telescope',
        'read menu-editor',
        'update menu-editor',
        'delete menu-editor',
        'create pages',
        'read pages',
        'delete pages',
        'create posts',
        'read posts',
        'delete posts',
        'settings',
        'export settings'
    ],
    'instagram' => [
        'templates' => [
            'post' => 'ورق بزنید

:title
:brand_model
:multicard
:variants

:description
_________________________

🌍 آدرس : :city_state
💰 قیمت : :price
☎️ شماره تماس : :contacts
وضعیت : موجود

_________________________

:hashtags'
        ]
    ]
];
