<?php

namespace Modules\Admin\Http\Controllers;

use App\Grids\AdsGrid;
use App\Grids\AdsSingleGrid;
use App\Grids\PromotionsGrid;
use App\Http\Requests\SearchRequest;
use App\Http\Resources\SearchResource;
use App\Models\Ad;
use App\Models\PhoneBrand;
use App\Models\Promotion;
use App\Notifications\AdAcceptedNotification;
use App\Notifications\AdIgnoredNotification;
use App\Space\Contracts\Searchable;
use GuzzleHttp\Psr7\FnStream;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\ValidationException;
use Modules\User\Entities\CityState;
use Modules\User\Entities\PhoneAccessory;
use Modules\User\Entities\PhoneAge;
use Modules\User\Entities\PhoneModel;
use Modules\User\Entities\PhoneVariant;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(AdsGrid $grid, Request $request)
    {
        $page_title = __(' Ads List ');

        $query = Ad::query();

        if (!$request->input('sort_by')) {

            $request->merge([
                'sort_by' => 'created_at',
                'sort_dir' => 'desc',
            ]);
        }

        return $grid
            ->create(compact('query', 'request'))
            ->renderOn('admin::grid.index', compact('page_title'));
    }

    /**\
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {
        return view('admin::ads.create', [
            'page_title' => __(' Create Ad '),
            'accessories' => PhoneAccessory::all(),
            'brands' => [],
            'ages' => PhoneAge::all(),
            'variants' => PhoneVariant::all(),
            'states' => [],
            'cities' => [],
            // temp
            'models' => [],
        ]);
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
    public function show(Ad $ad, AdsSingleGrid $adsSingleGrid, PromotionsGrid $promotionsGrid, Request $request)
    {
        $query = Ad::query();

        $query->whereId($ad->id);

        $grid = $adsSingleGrid->create(compact('request', 'query'));

        $columns = $grid->getProcessedColumns();
        $item = collect($grid->getData()->items())->first();

        $query = Promotion::query()->whereIn('id', $ad->promotions()->pluck('id'));
        $promGrid = $promotionsGrid->create(compact('request', 'query'));
        $promColumns = $promGrid->getProcessedColumns();
        $promItems = $grid->getData()->items();

        $templates = [
            [
                'title' => __(' Template Primary '),
                'url' => 'images/templates/1080/devicechi-insta-cover-primary-1080.png'
            ],
            [
                'title' => __(' Template Secondary '),
                'url' => 'images/templates/1080/devicechi-insta-cover-secondary-1080.png'
            ],
        ];

        $caption = render_ad_caption($ad);

        return view('admin::ads.show', compact(
            'caption',
            'templates',
            'ad',
            'item',
            'columns',
            'grid',
            'promGrid',
            'promColumns',
            'promItems'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        // return view('admin::edit');
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
    public function destroy(Ad $ad)
    {
        // soft delete
        $result = $ad->delete();

        if (!$result) {
            return abort(500, __(' Unable to delete ad! '));
        }

        return redirect()->back()->with('success', __(' Ad successfully deleted! '));
    }


    public function approveDestroy(Ad $ad)
    {
        $page_title = __(' Delete Ad ');

        return view('admin::ads.delete', compact('ad', 'page_title'));
    }

    public function forceDestroy(Ad $ad)
    {
        $ad->contacts()->delete();

        $result = $ad->forceDelete();

        if ($result) {
            session()->flash('success', __(' Ad successfully force deleted! '));
        }

        return redirect()->route('admin.ads.list');
    }

    public function restore(Ad $ad)
    {
        if ($ad->trashed()) {
            $result = $ad->restore();

            if ($result) {
                session()->flash('success', __('Successfully restored ad.'));
            }
        }

        return back();
    }

    public function accept(Ad $ad, Request $request)
    {
        $ad->accept($request->user()->id);

        if ($request->boolean('pro_ad')) {
            $ad->proSign();
        }

        if ($request->boolean('notify_user')) {
            $ad->notify(new AdAcceptedNotification);
        }

        return back()->with('success', __(' آگهی با موفقیت انتشار داده شد.'));
    }

    public function ignore(Ad $ad, Request $request)
    {
        $request->validate([
            'description' => ['required'],
        ]);

        $ad->ignore($request->description, $request->user()->id);

        if ($request->boolean('notify_ignored_user'))
            $ad->notify(new AdIgnoredNotification);

        return back()->with('success', __(' آگهی با موفقیت رد شد.'));
    }
}
