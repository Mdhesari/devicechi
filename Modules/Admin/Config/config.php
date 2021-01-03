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
        'create ad',
        'read ad',
        'update ad',
        'delete ad',

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
وضعیت : :status

_________________________

#گوشی_سامسونگ #گوشی_موبایل #گوشی_اپل #گوشی #گوشی_کارکرده #گوشی_دست_دوم #گوشی_ایفون #گوشی_هواوی #موبایل #موبایل_فروشی #موبایل_دست_دوم #موبایل_کارکرده #تلفن_همراه #آیفون #ایفون #ایفون۶ #ایفون۷ #ایفونx #آیفونxs #ایفون_۱۲مینی #سامسونگ #سامسونگ_نوت۲۰ #سامسونگ_s20 #ایفون۱۲ #آیفون_۱۲پرو #سامسونگa51 #فروش_گوشی #آیفون۱۲ #ریحانه_پارسا'
        ]
    ]
];
