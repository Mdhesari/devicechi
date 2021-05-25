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
        $userAgent = $request->userAgent();
        if (strpos($userAgent, 'Instagram')) {
            info('ok');
            return redirect()->route('instagram-redirect');
        }
        $data = [];
        $data['brands'] = PhoneBrand::limit(16)->get();
        $data['ads'] = Ad::with('state.city')->latest()->includeMediaThumb()->published()->limit(9)->get();
        $data['posts'] = Post::published()->latest()->limit(3)->get();

        return Inertia::render('Home', $data);
    }
}
