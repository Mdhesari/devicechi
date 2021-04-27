<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Http\Resources\SearchResource;
use App\Space\Contracts\Searchable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Entities\PhoneModel;

class AdminModelsController extends Controller implements Searchable
{
    public function search(SearchRequest $request)
    {
        $query = PhoneModel::query();

        $search = $request->input('search');

        $ignore = $request->input('ignore');

        if (!empty($ignore)) {

            $query->whereNotIn('id', $ignore);
        }

        if ($search)
            $query->where(function ($query) use ($search) {

                $query->searchLike(['name', 'brand.name'], $search);
            });

        $models = $query->paginate();
        return response([
            'results' => SearchResource::collection($models),
            "search" => $search,
            "pagination" => [
                "more" => $models->count() > 0
            ]
        ]);
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('admin::index');
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
