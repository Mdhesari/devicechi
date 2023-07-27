<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\Ad;
use Arr;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Http\Requests\AdExportRequest;
use Modules\User\Repositories\Contracts\AdRepositoryInterface;
use Modules\User\Repositories\Eloquent\AdRepository;
use Storage;
use Str;
use ZipArchive;

class AdExportController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Ad $ad, AdRepositoryInterface $repository, Request $request)
    {
        $repository->setModel($ad);

        $repository->createCaptionFile(render_ad_caption(
            $ad,
            $request->input('caption')
        ));

        $repository->renderPicturesToExport(
            $request->input('template'),
            $request->input('quality', 100),
            $request->boolean('dont_overwrite'),

        );

        $zip_path = store_dir_to_zip(
            Storage::path($repository->getExportDirname()),
            'export.zip'
        );

        return response()->download($zip_path);
    }

    public function renewCaption(Ad $ad, AdRepositoryInterface $repository, Request $request)
    {
        $repository->setModel($ad);

        $repository->createCaptionFile(render_ad_caption(
            $ad,
            $request->input('caption'),
            true
        ));

        return back();
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
