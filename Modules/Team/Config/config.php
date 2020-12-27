<?php

return [
    'name' => 'Team',
    'users' => [
        [
            'name' => 'Mohamad Fazel',
            'email' => 'mdhesari99@gmail.com',
            'password' => '123Md123',
        ]
    ],
    'domain' => env('TEAM_DOMAIN', 'http://localhost'),
    'prefix' => env('TEAM_PREFIX', '/team'),
];
