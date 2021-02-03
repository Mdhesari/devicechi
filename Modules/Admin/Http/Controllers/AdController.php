<?php

namespace Modules\Admin\Http\Controllers;

use App\Grids\AdsGrid;
use App\Grids\AdsSingleGrid;
use App\Models\Ad;
use App\Notifications\AdAcceptedNotification;
use App\Notifications\AdIgnoredNotification;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

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

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        // return view('admin::create');
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
    public function show(Ad $ad, AdsSingleGrid $adsSingleGrid, Request $request)
    {
        $query = Ad::query();

        $query->whereId($ad->id);

        $grid = $adsSingleGrid->create(compact('request', 'query'));

        $columns = $grid->getProcessedColumns();
        $item = collect($grid->getData()->items())->first();

        $templates = [
            [
                'title' => __(' Template 1 '),
                'url' => 'images/template-1.png'
            ],
            [
                'title' => __(' Template 1 '),
                'url' => 'images/template-2.png'
            ],
        ];

        $caption = render_ad_caption($ad);

        return view('admin::ads.show', compact(
            'caption',
            'templates',
            'ad',
            'item',
            'columns',
            'grid'
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
    public function destroy($id)
    {
        //
    }

    public function accept(Ad $ad, Request $request)
    {
        $ad->accept($request->user()->id);

        if ($request->boolean('pro_ad')) {

            $ad->proSign();
        }

        if ($request->boolean('notify_user'))
            $ad->notify(new AdAcceptedNotification);

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
