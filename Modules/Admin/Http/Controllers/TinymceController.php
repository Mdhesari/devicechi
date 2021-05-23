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
        $request->dd();
        if ($request->hasFile('upload')) {

            $validator = Validator::make($request->only('upload'), [
                'upload' => ['image', 'max:' . config('admin.max_upload_size')]
            ]);

            @header('Content-type: text/html; charset=utf-8');

            if ($validator->fails()) {
                $response = "<script>alert(" .  __(" The file is too big! ") . ")</script>";

                echo $response;
                die;
            }

            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $path = 'uploads/' . now()->format('Y') . '/' . now()->format('M');

            $path = $request->upload->storeAs($path, $fileName);

            $url = url(Storage::url($path));
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');

            $msg = __(' Image uploaded successfully ');

            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            echo $response;
        }
    }
}
