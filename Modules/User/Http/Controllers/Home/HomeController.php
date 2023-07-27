<?php

namespace Modules\User\Http\Controllers\Home;

use App\Models\Ad;
use App\Models\PhoneBrand;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Modules\User\Entities\City;
use Modules\User\Http\Controllers\Controller;

class HomeController extends Controller
{

    /**
     * Show home page
     *
     * @return void
     */
    public function index(Request $request)
    {
        $data = [];
        $data['using_instagram'] = false;
        $data['brands'] = PhoneBrand::limit(16)->get();
        $data['ads'] = Ad::with('state.city')->latest()->includeMediaThumb()->published()->limit(9)->get();
        $data['posts'] = Post::published()->latest()->limit(3)->get();

        $userAgent = $request->userAgent();
        if (strpos($userAgent, 'Instagram')) {
            $data['using_instagram'] = true;
        }

        return Inertia::render('Home', $data);
    }
}
