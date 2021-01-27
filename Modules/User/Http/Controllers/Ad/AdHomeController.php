<?php

namespace Modules\User\Http\Controllers\Ad;

use App\Http\Resources\AdResource;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Ad;
use Log;
use Modules\User\Entities\PhoneAccessory;

class AdHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {

        $ads = Ad::with('state.city')->includeMediaThumb()->published()->get();

        $proAds = Ad::with('state.city')->published()->filterPro()->limit(3)->get();

        return inertia('Ad/Home', compact('ads', 'proAds'));
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function all(Request $request)
    {
        $ads = Ad::with('state.city')->filterAd($request)->includeMediaThumb()->published()->get();

        $search = $request->input('q');

        return inertia('Ad/Ads', compact('ads', 'search'));
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
     * search ads
     * @param Request $request
     * @return Renderable
     */
    public function search(Request $request)
    {

        return response()->json([
            'ads' => Ad::published()->with('phoneModel.brand', 'state.city')->filterAd($request)->paginate()
        ]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Ad $ad, Request $request)
    {

        if (!$ad->isPublished())
            return redirect()->route('user.ad.step_phone_demo', [
                'ad' => $ad,
            ]);

        $ad->loadSingleRelations()
            ->append('short_url');

        $user = $request->user();

        $is_bookmarked_for_user = $user->bookmarkedAds()->whereAdId($ad->id)->count() > 0;

        $user->readAd($ad);

        $accessories = PhoneAccessory::whereNotIn('id', $ad->accessories()->select('id')->pluck('id'))->get();

        return inertia('Ad/Single', compact('ad', 'accessories', 'is_bookmarked_for_user'));
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
}
