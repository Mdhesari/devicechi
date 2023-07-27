<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use Illuminate\Http\Request;

class ShortLinkController extends Controller
{
    /**
     * Show shortlink
     *
     * @param  mixed $code
     * @return void
     */
    public function show($code)
    {

        $shortL = ShortLink::whereCode($code)->first();

        $linkArr = parse_url($shortL->link);

        if (isset($linkArr['schema'])) return redirect();

        return redirect($shortL->link);
    }
}
