<?php

namespace Modules\Admin\Http\Controllers;

use App\Grids\PhoneBrandsGrid;
use App\Http\Requests\SearchRequest;
use App\Http\Resources\SearchResource;
use App\Models\PhoneBrand;
use App\Space\Contracts\Searchable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminBrandController extends Controller implements Searchable
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(PhoneBrandsGrid $grid, Request $request)
    {
        $page_title = __(' Ads List ');

        $query = PhoneBrand::query();

        return $grid
            ->create(compact('query', 'request'))
            ->renderOn('admin::grid.index', compact('page_title'));
    }

    public function search(SearchRequest $request)
    {
        $query = PhoneBrand::query();

        $search = $request->input('search');

        $ignore = $request->input('ignore');

        if (!empty($ignore)) {

            $query->whereNotIn('id', $ignore);
        }

        if ($search)
            $query->where(function ($query) use ($search) {

                $query->searchLike(['name', 'persian_name'], $search);
            });

        $brands = $query->paginate();
        return response([
            'results' => SearchResource::collection($brands),
            "search" => $search,
            "pagination" => [
                "more" => $brands->count() > 0
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('admin::create');
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
        return view('admin::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('admin::edit');
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
