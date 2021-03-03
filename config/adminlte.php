<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/8.-Menu-Configuration
    |
    */

    'menu' => [
        'admin_sidebar' => [
            [
                'text' => ' Dashboard ',
                'permission' => 'read user',
                'route' => 'admin.dashboard',
                'route_params' => [],
                'icon' => 'fa fa-tachometer-alt nav-icon',
            ],
            [
                'text' => ' Menus ',
                'permission' => 'read menu-editor',
                'route' => 'admin.menu-editor.show',
                'route_params' => [],
                'icon' => 'fa fa-bars nav-icon',
            ],
            [
                'text' =>  ' Ads Management ',
                'permission' => 'read ad',
                'icon' => 'fab fa-buysellads nav-icon',
                'submenu' => [
                    [
                        'text' => ' Ads List ',
                        'route' => 'admin.ads.list',
                        'route_params' => [],
                        'icon' => 'fa fa-list-ul nav-icon'
                    ],
                ],
            ],
            [
                'text' =>  ' User Management ',
                'permission' => 'read user',
                'icon' => 'fa fa-users',
                'submenu' => [
                    [
                        'text' => ' Users List ',
                        'route' => 'admin.users.list',
                        'route_params' => [],
                        'icon' => 'fa fa-list-ul nav-icon'
                    ],
                    [
                        'text' => ' Create User ',
                        'route' => 'admin.users.add',
                        'route_params' => [],
                        'icon' => 'fa fa-plus nav-icon'
                    ],
                ],
            ],
            [
                'text' => ' Admin Management ',
                'permission' => 'read admin',
                'icon' => 'fa fa-users',
                'submenu' => [
                    [
                        'text' => ' Admins List ',
                        'route' => 'admin.admins.list',
                        'route_params' => [],
                        'icon' => 'fa fa-list-ul nav-icon',
                    ],
                    [
                        'text' => ' Create Admin ',
                        'route' => 'admin.admins.add',
                        'route_params' => [],
                        'icon' => 'fa fa-plus nav-icon'
                    ],
                ],
            ],
            [
                'text' => ' Activity Log ',
                'permission' => 'activity-log-management',
                'icon' => 'fa fa-database',
                'submenu' => [
                    [
                        'text' => ' Users Activity Log ',
                        'route' => 'admin.activity.report',
                        'route_params' => [],
                        'icon' => 'fa fa-history'
                    ],
                ],
            ],
            [
                'text' => ' Access Management ',
                'permission' => 'access-management',
                'icon' => 'fa fa-universal-access',
                'submenu' => [
                    [
                        'text' => ' Manage Role permissions ',
                        'route' => 'admin.role-permission.index',
                        'route_params' => [],
                        'icon' => 'fa fa-lock'
                    ],
                ],
            ],
            [
                'text' => ' Payment Management ',
                'permission' => 'read payment',
                'icon' => 'fas fa-shopping-basket',
                'submenu' => [
                    [
                        'text' => ' Payment List ',
                        'route' => 'admin.payments.list',
                        'route_params' => [],
                        'icon' => 'fa fa-list-ul nav-icon'
                    ],
                    [
                        'text' => ' Add Payment ',
                        'route' => 'admin.payments.add',
                        'route_params' => [],
                        'icon' => 'fa fa-plus nav-icon'
                    ],
                ],
            ],
            [
                'text' => ' Media Management ',
                'permission' => 'read media',
                'icon' => 'fas fa-file-image ',
                'submenu' => [
                    [
                        'text' => ' Media Editor ',
                        'route' => 'admin.media.home',
                        'route_params' => [],
                        'icon' => 'far fa-edit',
                    ],
                ]
            ],
            [
                'text' => ' Contact us ',
                'permission' => 'contact user',
                'icon' => 'ion-help-circled',
                'submenu' => [
                    [
                        'text' => ' Contacts ',
                        'route' => 'admin.contact-us.list',
                        'route_params' => [],
                        'icon' => 'fa fa-support',
                    ],
                ],
            ],
        ],
        'admin_topnav' => [
            [
                'text' => ' Home ',
                'route' => 'admin.dashboard',
            ],
            [
                'text' => ' Contacts ',
                'route' => 'admin.contact-us.list',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we permission modify the menu filters of the admin panel.
    |
    */

    'filters' => [
        App\Menu\Filters\GateFilter::class,
        App\Menu\Filters\HrefFilter::class,
        App\Menu\Filters\SearchFilter::class,
        App\Menu\Filters\ActiveFilter::class,
        App\Menu\Filters\ClassesFilter::class,
        App\Menu\Filters\LangFilter::class,
        App\Menu\Filters\DataFilter::class,
    ],
];
