<?php

namespace Modules\User\Http\Controllers\Ad;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Entities\PhoneVariant;

class AdVariantController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([
            'variant_id' => 'required|exists:phone_variants,id'
        ]);

        $ad = auth()->user()->ads()->uncompleted()->first();

        $ad->phone_model_variant_id = $request->variant_id;
        $ad->save();

        return 'ok';
    }
}
