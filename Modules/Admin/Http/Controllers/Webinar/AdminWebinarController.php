<?php

namespace Modules\Admin\Http\Controllers\Webinar;

use App\Grids\WebinarsGrid;
use App\Http\Controllers\Webinar\WebinarController;
use App\Models\Category\Category;
use App\Models\Webinar\Webinar;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Http\Requests\ChangeStatusWebinarRequest;
use Modules\Main\Entities\User\User;

class AdminWebinarController extends WebinarController
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {

        return view('admin::index');
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function create()
    {
        $page_title = __(' Create Webinar ');
        $categories = Category::all();
        return view('admin::webinars.create', compact('page_title', 'categories'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function continueCreate($id)
    {
        $webinar = Webinar::findOrFail($id);;
        $users = User::all();
        $page_title = __($webinar->title);
        return view('admin::webinars.continueCreate', compact('page_title','webinar', 'users'));
    }
    public function list(Request $request, WebinarsGrid $webinarsGrid)
    {
        $page_title = __(' Webinar List ');

        $query = Webinar::query();

        return $webinarsGrid
            ->create(compact('query', 'request'))
            ->renderOn('admin::grid.index', compact('page_title'));
    }
    public function edit(Webinar $webinar)
    {

        $page_title = __(' Edit Webinar ');

        $categories = Category::all();

        return view('admin::webinars.edit', compact('page_title','webinar', 'categories'));

    }


    public function delete(Webinar $webinar)
    {
        $webinar->delete();

        return redirect()->back()->with('success', __(' successfully deleted '));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Webinar $webinar)
    {
        $page_title = $webinar->title;
        $status = Webinar::STATUS; 
        return view('admin::webinars.show', compact('page_title','webinar', 'status'));
    }
    
    public function changeStatus(ChangeStatusWebinarRequest $request, Webinar $webinar)
    {
        $webinar->update([
            'status' => $request->status,
        ]);
        return redirect()->back()->with('success', __(' successfully updated '));
    }

}
