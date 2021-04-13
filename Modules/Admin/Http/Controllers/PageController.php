<?php

namespace Modules\Admin\Http\Controllers;

use App\Grids\PagesGrid;
use App\Models\Page;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Http\Requests\PageCreateRequest;

class PageController extends Controller
{

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function index(Request $request, PagesGrid $grid)
    {
        $page_title = __(' Pages List ');

        $query = Page::query();

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
        $page_title = __(' Create New Page ');

        return view('admin::pages.create', compact('page_title'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(PageCreateRequest $request)
    {
        $admin = $request->user();

        if ($request->slug) {
            $request->merge([
                'slug' => SlugService::createSlug(
                    Page::class,
                    'slug',
                    trim($request->slug, '/')
                ),
            ]);
        }

        $admin->pages()->create($request->all());

        if ($image = $request->input('featured_image', false)) {

            dd($image);
        }

        return back()->with('success', __(' Successful! '));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Page $page
     * @return Renderable
     */
    public function edit(Page $page)
    {
        $page_title = __(' Create New Page ');

        return view('admin::pages.edit', compact('page_title', 'page'));
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
