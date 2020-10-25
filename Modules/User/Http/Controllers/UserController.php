<?php

namespace Modules\User\Http\Controllers;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Inertia\Inertia;
use Log;
use Modules\User\Entities\User;
use Modules\User\Events\UserRegistered;
use Response;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return 'user home';
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('user::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'phone' => 'required|min:6',
        ]);

        $user = User::where('phone', $request->input('phone'))->first();

        if (!is_null($user)) {

            return $this->loginUser($request);
        }

        return $this->registerUser($request);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('user::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('user::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Login user
     *
     * @return void
     */
    private function loginUsre($request)
    {

        //
    }

    private function registerUser($request)
    {

        try {

            User::create([
                'phone' => $request->input('phone'),
            ]);

            event(new UserRegistered(
                $request,
            ));

            return Response::json([
                'status' => 1,
            ]);
        } catch (Exception $e) {

            report($e);

            return Response::json([
                'status' => 0,
            ]);
        }
    }
}
