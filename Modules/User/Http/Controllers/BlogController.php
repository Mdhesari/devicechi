<?php

namespace Modules\User\Http\Controllers;

use App\Models\Post;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $data = [];

        $data['posts'] = Post::published()->latest()->paginate();

        if ($request->expectsJson()) {
            return $data['posts'];
        }

        return inertia('Blog/Home', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('user::create');
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
     * @param Post $post
     * @return Renderable
     */
    public function show(Post $post, Request $request)
    {

        $meta = $post->meta;
        $head_title = $post->title . ' | ' . config('app.name');
        $head_desc = $post->excerpt ?: '';

        SEOTools::setTitle($head_title);
        SEOTools::setDescription($head_desc);
        SEOTools::opengraph()->setUrl($request->getUri());

        \SEOMeta::setTitle($post->metaTagTitle);
        \SEOMeta::setDescription($post->metaDescription);
        \SEOMeta::setKeywords($post->metaKeywords);

        return inertia('Blog/Show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('user::edit');
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
