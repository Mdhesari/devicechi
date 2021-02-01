<?php

return [
    'default' => 'global',
    'global' => [
        [
            'title' => __(' Dashboard '),
            'permission' => 'read user',
            'route' => 'admin.dashboard',
            'route_params' => [],
            'icon_class' => 'fa fa-dashboard nav-icon',
        ],
        [
            'label' =>  __(' Ads Management '),
            'permission' => 'read ad',
            'icon_class' => 'fa fa-buysellads nav-icon',
            [
                'title' => __(' Ads List '),
                'route' => 'admin.ads.list',
                'route_params' => [],
                'icon_class' => 'fa fa-list-ul nav-icon'
            ],
        ],
        [
            'label' =>  __(' User Management '),
            'permission' => 'read user',
            'icon_class' => 'fa fa-users',
            [
                'title' => __(' Users List '),
                'route' => 'admin.users.list',
                'route_params' => [],
                'icon_class' => 'fa fa-list-ul nav-icon'
            ],
            [
                'title' => __(' Create User '),
                'route' => 'admin.users.add',
                'route_params' => [],
                'icon_class' => 'fa fa-plus nav-icon'
            ],
        ],
        [
            'label' => __(' Admin Management '),
            'permission' => 'read admin',
            'icon_class' => 'fa fa-users',
            [
                'title' => __(' Admins List '),
                'route' => 'admin.admins.list',
                'route_params' => [],
                'icon_class' => 'fa fa-list-ul nav-icon',
            ],
            [
                'title' => __(' Create Admin '),
                'route' => 'admin.admins.add',
                'route_params' => [],
                'icon_class' => 'fa fa-plus nav-icon'
            ],
        ],
        [
            'label' => __(' Activity Log '),
            'permission' => 'activity-log-management',
            'icon_class' => 'fa fa-database',
            [
                'title' => __(' Users Activity Log '),
                'route' => 'admin.activity.report',
                'route_params' => [],
                'icon_class' => 'fa fa-history'
            ]
        ],
        [
            'label' => __(' Access Management '),
            'permission' => 'access-management',
            'icon_class' => 'fa fa-universal-access',
            [
                'title' => __(' Manage Role Permissions '),
                'route' => 'admin.role-permission.index',
                'route_params' => [],
                'icon_class' => 'fa fa-lock'
            ]
        ],
        [
            'label' => __(' Payment Management '),
            'permission' => 'read payment',
            'icon_class' => 'fa fa-money',
            [
                'title' => __(' Payment List '),
                'route' => 'admin.payments.list',
                'route_params' => [],
                'icon_class' => 'fa fa-list-ul nav-icon'
            ],
            [
                'title' => __(' Add Payment '),
                'route' => 'admin.payments.add',
                'route_params' => [],
                'icon_class' => 'fa fa-plus nav-icon'
            ],
        ],

        [
            'label' => __(' Media Management '),
            'permission' => 'read media',
            'icon_class' => 'fa fa-file-o',
            [
                'title' => __(' Media Editor '),
                'route' => 'admin.media.home',
                'route_params' => [],
                'icon_class' => 'fa fa-files-o',
            ],
        ],

        [
            'label' => __(' Contact us '),
            'permission' => 'contact user',
            'icon_class' => 'ion-help-circled',
            [
                'title' => __(' Contacts '),
                'route' => 'admin.contact-us.list',
                'route_params' => [],
                'icon_class' => 'fa fa-support',
            ],
        ],
    ],
];
