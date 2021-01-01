<?php

namespace Modules\Admin\Http\Controllers;

use App\Grids\CategoryGrid;
use App\Models\Category\Category;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Http\Requests\StoreCategoryRequest;
use Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @param CategoryGrid $categoryGrid
     * @return Renderable
     */
    protected $data;
    protected $output;
    public function list(Request $request, CategoryGrid $categoryGrid)
    {
        $page_title = __(' Webinar List ');

        $query = Category::query();

        return $categoryGrid
            ->create(compact('query', 'request'))
            ->renderOn('admin::grid.index', compact('page_title'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $categories = Category::all();
        $page_title = __(' Create Category ');
        return view('admin::category.create', compact('page_title', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     * @param Category $category
     * @return Renderable
     */
    public function edit(Category $category)
    {
        $categories = Category::all();

        $page_title = __(' Edit Category ');

        return view('admin::category.edit', compact('page_title', 'categories', 'category'));
    }
    public function delete(Category $category)
    {
        $categories = Category::all();

        $page_title = __(' Delete Category ');

        return view('admin::category.delete', compact('page_title', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     * TODO:must be deleted.
     */
    public function search()
    {
        return view('admin::components.livesearch');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|Renderable|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreCategoryRequest $request)
    {
        Category::create($request->all());

        return redirect(route('admin.category.list'));
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
     * Update the specified resource in storage.
     * @param StoreCategoryRequest $request
     * @param Category $category
     * @return \Illuminate\Contracts\Foundation\Application|Renderable|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Category $category)
    {
        $request = Validator::make($request->all(), [
            
            'title' => 'string|required|min:3|max:255',
            'parent_id' => [

                function ($attribute, $value, $fail) use ($category) {

                    if ($category->id == $value || $category->isAncestorOf(Category::find($value))) {
                        
                        $fail('The ' . $attribute . ' is invalid.');
                    }
                },
            ],

        ])->validate();

        $category->update($request);

        return redirect(route('admin.category.list'));
    }

    /**
     * Remove the specified resource from storage.
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Category $category, Request $request)
    {

        if (!$request->delete_childs) {

            foreach ($category->children()->cursor() as $child) {

                $child->update([
                    'parent_id' => $category->parent_id
                ]);
            }
               
        }

        $category->delete();

        return redirect(route('admin.category.list'));
    }

}
