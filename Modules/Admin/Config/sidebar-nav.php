<?php

return [
    'default' => 'global',
    'global' => [
        [
            'title' => __(' Dashboard '),
            'permission' => 'read user',
            'route' => 'dashboard',
            'route_params' => [],
            'icon_class' => 'fa fa-panel',
        ],
        [
            'label' =>  __(' User Management '),
            'permission' => 'read user',
            [
                'title' => __(' Users List '),
                'route' => 'admin.users.list',
                'route_params' => [],
                'icon_class' => 'fa fa-users nav-icon'
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
            [
                'title' => __(' Admins List '),
                'route' => 'admin.admins.list',
                'route_params' => [],
                'icon_class' => 'fa fa-users nav-icon'
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
            [
                'title' => __(' Payment List '),
                'route' => 'admin.payments.list',
                'route_params' => [],
                'icon_class' => 'fa fa-card'
            ],
            [
                'title' => __(' Add Payment '),
                'route' => 'admin.payments.add',
                'route_params' => [],
                'icon_class' => 'fa fa-plus'
            ],
        ],
    ],
];
