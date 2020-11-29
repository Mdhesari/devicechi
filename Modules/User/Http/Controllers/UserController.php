<?php

namespace Modules\User\Http\Controllers;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Inertia\Inertia;
use Log;
use Modules\User\Entities\Ad;
use Modules\User\Entities\User;
use Modules\User\Events\UserLoggedIn;
use Modules\User\Events\UserRegistered;
use Modules\User\Repositories\Contracts\AdRepositoryInterface;
use Response;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request, AdRepositoryInterface $adRepository)
    {

        $user = $request->user();

        $all_status = $adRepository->getAllStatus();

        return inertia('User/Profile', compact('user', 'all_status'));
    }
}
