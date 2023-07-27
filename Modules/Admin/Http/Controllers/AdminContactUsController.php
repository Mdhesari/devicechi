<?php

namespace Modules\Admin\Http\Controllers;

use App\Grids\ContactUsGrid;
use App\Models\ContactUs;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(ContactUsGrid $grid, Request $request)
    {
        $page_title = __(" Contact Us ");

        $query = ContactUs::query();

        return $grid
            ->create(compact('query', 'request'))
            ->renderOn('admin::grid.index', compact('page_title'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(ContactUs $contactu, ContactUsGrid $grid, Request $request)
    {

        $query = ContactUs::query();

        $query->whereId($contactu->id);

        $grid = $grid->create(compact('request', 'query'));

        $columns = $grid->getProcessedColumns();
        $item = collect($grid->getData()->items())->first();

        return view('admin::grid.show', compact(
            'item',
            'columns',
            'grid'
        ));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(ContactUs $contactu)
    {
        $contactu->delete();

        return back()->with('success', __(' Deleted successfully '));
    }
}
