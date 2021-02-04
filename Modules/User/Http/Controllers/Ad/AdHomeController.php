<?php

namespace Modules\User\Http\Controllers\Ad;

use App\Http\Resources\AdResource;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Ad;
use Artesaos\SEOTools\Facades\TwitterCard;
use JsonLd;
use Log;
use Modules\User\Entities\PhoneAccessory;
use OpenGraph;
use SEOMeta;

class AdHomeController extends Controller
{
    /**
     * Display Ad home
     * @return Renderable
     */
    public function index(Request $request)
    {

        $query = Ad::with('state.city')->latest()->includeMediaThumb()->published();

        $ads = $query->paginate();

        if ($request->expectsJson()) return $ads;

        $proAds = $query->filterPro()->take(3)->get();

        return inertia('Ad/Home', compact('ads', 'proAds'));
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function all(Request $request)
    {
        $ads = Ad::with('state.city')->latest()->filterAd($request)->includeMediaThumb()->published()->paginate(3);

        if ($request->expectsJson()) return $ads;

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
        $ads = Ad::with('phoneModel.brand', 'state.city')->publishedWithFilter($request)->latest()->paginate(4);

        return response()->json([
            'ads' => $ads
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

        $head_title = $ad->title;
        $head_desc = $ad->description;

        OpenGraph::setDescription($head_desc);
        OpenGraph::setTitle($head_title);
        OpenGraph::setUrl(route('user.ad.show', $ad));
        OpenGraph::addProperty('type', 'ads');

        TwitterCard::setTitle($head_title);
        TwitterCard::setSite(config('app.name'));

        JsonLd::setTitle($head_title);
        JsonLd::setDescription($head_desc);
        JsonLd::addImage($ad->media->first()->getFullUrl());

        SEOMeta::setTitle($head_title);
        SEOMeta::setDescription($head_desc);

        return inertia('Ad/Single', compact('ad', 'head_title', 'head_desc', 'accessories', 'is_bookmarked_for_user'))
            ->withViewData(compact('head_title', 'head_desc'));
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
