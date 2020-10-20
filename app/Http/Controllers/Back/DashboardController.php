<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Render dashboard
     *
     * @return mixed
     */
    public function index() {

        Inertia::setRootView('layouts/back');

        return Inertia::render('Dashboard');
    }
}
