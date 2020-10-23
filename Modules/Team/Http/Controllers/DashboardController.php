<?php

namespace Modules\Team\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{

    public function __construct()
    {
        Inertia::setRootView('layouts/back');
    }
    /**
     * Render dashboard
     *
     * @return mixed
     */
    public function index()
    {

        return Inertia::render('Dashboard');
    }
}
