<?php

namespace Modules\User\Http\Controllers;

use App\Http\Resources\PromotionResource;
use App\Models\Ad;
use App\Models\Promotion;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Repositories\Eloquent\PromotionRepository;

class AdPromoteController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Ad $ad, Request $request)
    {
        $promotions = PromotionResource::collection(Promotion::all());

        return inertia('Ad/Promote', compact('ad', 'promotions'));
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
        //
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

    public function getFinalPrice(Request $request, PromotionRepository $repository)
    {
        $request->validate([
            'promotions' => ['required', 'array'],
        ]);

        return $repository->evaluateFinalPrice($request->promotions);
    }
}
