<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
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
