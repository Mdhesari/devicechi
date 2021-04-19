<?php

namespace Modules\User\Http\Controllers;

use App\Models\Ad;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Repositories\Eloquent\PromotionRepository;

class UserPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {

        $payments = $request->user()->payments()->select('title', 'amount',  'status', 'created_at')->get();

        $nav_items = get_nav_items();

        $tabs = [];

        return inertia('User/MyPayments', compact('payments', 'tabs', 'nav_items'));
    }

    public function gateway(Ad $ad, Request $request, PromotionRepository $repository)
    {
        $request->validate([
            'promotions' => 'required|array',
        ]);

        $finalPrice = $repository->evaluateFinalPrice($request->promotions);

        // store payment and redirect to gateway api
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
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }
}
