<?php

namespace Modules\Admin\Http\Controllers;

use App\Grids\PagesGrid;
use App\Models\Page;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;
use Modules\Admin\Http\Requests\PageCreateRequest;
use Validator;

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

        $page = $admin->pages()->create($data = $request->all());
        $page->updateMeta($data);

        //TODO for future updates
        if ($image = $request->input('featured_image', false)) {

            dd($image);
        }

        return redirect()->route('admin.pages.list')->with('success', __(' Successful! '));
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
     * @param Page $page
     * @return Renderable
     */
    public function update(Request $request, Page $page)
    {
        Validator::make($request->all(), [
            'title' => ['required', 'min:3'],
            'slug' => [Rule::unique('pages', 'slug')->ignore($page->id)],
        ]);

        $page->update($data = $request->all());
        $page->updateMeta($data);

        return back()->with('success', __(' Successful! '));
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
