<?php

namespace Modules\Team\Http\Controllers;

use Inertia\Inertia;

class Controller extends \App\Http\Controllers\Controller
{

    public function __construct()
    {
        Inertia::setRootView('team::layouts.team');
    }
}
