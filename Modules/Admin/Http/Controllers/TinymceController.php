<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Storage;
use Validator;

class TinymceController extends Controller
{
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        if ($request->hasFile('file')) {

            $validator = Validator::make($request->only('file'), [
                'file' => ['image', 'max:' . config('admin.max_upload_size')]
            ]);

            if ($validator->fails()) {
                $response = "<script>alert(" .  __(" The file is too big! ") . ")</script>";

                echo $response;
                die;
            }

            $originName = $request->file('file')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('file')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $path = 'uploads/' . now()->format('Y') . '/' . now()->format('M');

            $path = $request->file->storeAs($path, $fileName);

            $url = url(Storage::url($path));

            return response()->json([
                'location' => $url,
            ]);
        }
    }
}
