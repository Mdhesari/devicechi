<?php

namespace Modules\Admin\Http\Controllers;

use App\Grids\PostsGrid;
use App\Models\Post;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;
use Modules\Admin\Http\Requests\PostCreateRequest;
use Validator;

class AdminPostController extends Controller
{
    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function index(Request $request, PostsGrid $grid)
    {
        $page_title = __(' Posts List ');

        $query = Post::query();

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
        $page_title = __(' Create New Post ');
        $statusList = Post::getStatusList();
        return view('admin::posts.create', compact('page_title', 'statusList'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(PostCreateRequest $request)
    {
        $admin = $request->user();

        if ($request->slug) {
            $request->merge([
                'slug' => SlugService::createSlug(
                    Post::class,
                    'slug',
                    trim($request->slug, '/')
                ),
            ]);
        }

        $post = $admin->posts()->create($data = $request->all());
        $post->updateMeta($data);
        $post->updateStatus($data['status']);

        if ($file = $request->featured_image) {
            $post->addMedia($file)->toMediaCollection(Post::MEDIA_FEATURED_IMAGE);
        }

        return redirect()->route('admin.posts.list')->with('success', __(' Successful! '));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Post $post
     * @return Renderable
     */
    public function edit(Post $post)
    {
        $page_title = __(' Edit Post ');
        $statusList = Post::getStatusList();

        return view('admin::posts.edit', compact('page_title', 'post', 'statusList'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Post $post
     * @return Renderable
     */
    public function update(Request $request, Post $post)
    {
        Validator::make($request->all(), [
            'title' => ['required', 'min:3'],
            'slug' => [Rule::unique('pages', 'slug')->ignore($post->id)],
        ]);

        $post->update($data = $request->all());
        $post->updateMeta($data);
        $post->updateStatus($data['status']);

        if ($file = $request->featured_image) {
            $post->addMedia($file)->toMediaCollection(Post::MEDIA_FEATURED_IMAGE);
        }

        return back()->with('success', __(' Successful! '));
    }


    public function delete(Post $post)
    {
        return view('admin::posts.delete', compact('post'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.list')->with('success', __(' Successful! '));
    }
}
