<?php

namespace Modules\Admin\Http\Controllers;

use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Str;

class AdminSlugController extends Controller
{
    public function generate(Request $request)
    {
        $className = (string) Str::of($request->className)->replace('-', '\\');

        if (!app($className) || !$slug = $request->slug) {
            return '';
        }

        return SlugService::createSlug(
            $className,
            'slug',
            trim($slug, '/')
        );
    }
}
