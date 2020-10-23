<?php

namespace Modules\User\Http\Controllers;

use Inertia\Inertia;

class Controller extends \App\Http\Controllers\Controller
{

    public function __construct()
    {
        Inertia::setRootView('user::layouts.app');
    }
}
