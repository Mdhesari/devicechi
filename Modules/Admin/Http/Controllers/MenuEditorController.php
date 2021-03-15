<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Resources\MenuEditorForDBResource;
use App\Http\Resources\MenuEditorItemsResource;
use App\Http\Resources\MenuItemsResource;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Space\MenuItemFactory;
use GuzzleHttp\Psr7\FnStream;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Http\Requests\MenuGroupRequest;
use Symfony\Component\HttpKernel\Exception\HttpException;

class MenuEditorController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $menu = Menu::filterBasedOnRequest($request)->first();

        if (!$menu) {
            return abort(404);
        }

        $items = MenuEditorItemsResource::collection($menu->items)->toArray($request);
        $groups = Menu::all();

        $items = array_filter($items, function ($item) {
            if (isset($item['header'])) {
                return false;
            }

            return true;
        });

        $items = array_values($items);

        return view('admin::menu-editor.index', compact('menu', 'items', 'groups'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('admin::menu-editor.create');
    }

    public function store(MenuGroupRequest $request)
    {
        $menu = Menu::create($request->all());

        return redirect()->route("admin.menu-editor.show", [
            'group' => $menu->key,
        ]);
    }

    public function storeItems(Menu $menu, Request $request)
    {
        $items = json_decode($request->input('items'), true);

        $items = MenuItemsResource::collection($items)->toArray($request);

        $res = $menu->items()->delete();

        app(MenuItemFactory::class)->buildAndStoreMenuItems($menu, $items);

        cache()->forget(get_cache_menu_full_key($menu->key));

        return back();
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

    public function delete(Menu $menu)
    {
        return view('admin::menu-editor.delete', compact('menu'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Menu $menu)
    {
        $menu->items()->delete();
        $menu->delete();

        return \redirect()->route('admin.menu-editor.show')->with('success', __(' Menu Deleted! '));
    }
}
