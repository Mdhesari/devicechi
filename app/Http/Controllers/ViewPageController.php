<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Http\Request;
use Inertia\Inertia;
use JsonLd;
use OpenGraph;
use SEOMeta;

class ViewPageController extends Controller
{
    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Request $request)
    {
        $slug = trim(urldecode($request->getPathInfo()), '/');
        $page = Page::whereSlug($slug)->latest()->first();

        if ($page) {
            $head_title = $page->title . ' | ' . config('app.name');
            $head_desc = $page->excerpt ?: '';
            $meta = $page->meta;

            SEOTools::setTitle($head_title);
            SEOTools::setDescription($head_desc);
            SEOTools::opengraph()->setUrl($request->getUri());

            if ($meta && isset($meta['keywords'])) {
                SEOMeta::setKeywords($meta['keywords']);
            }
            // SEOTools::jsonLd()->addImage('https://codecasts.com.br/img/logo.jpg');

            return Inertia::render('Pages/Show', compact('page', 'head_title', 'head_desc'))->withViewData(compact('head_title', 'head_desc'));
        }

        return abort(404);
    }
}
