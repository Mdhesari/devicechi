<?php

namespace Modules\Admin\Http\Controllers;

use App\Settings\ExportSettings;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\ValidationException;

class ExportSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(ExportSettings $settings)
    {
        $page_title = __(' Settings ');
        $font_name = '';

        if ($font_path = $settings->font_path) {
            $font_path = pathinfo($font_path);
            $font_name = optional($font_path)['filename'];
        }

        return view('admin::export-settings.index', compact('settings', 'font_name', 'page_title'));
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $settings
     * @return void
     */
    public function update(Request $request, ExportSettings $settings)
    {
        $request->validate([
            'font' => 'required|file',
        ]);

        $originName = $request->file('font')->getClientOriginalName();
        $fileName = pathinfo($originName, PATHINFO_FILENAME);
        $extension = $request->file('font')->getClientOriginalExtension();
        $fileName = $fileName . '.' . $extension;

        $path = $request->font->storeAs('setting/export/fonts', $fileName, 'public');

        if (file_exists($path = storage_path('app/public/' . $path))) {
            $settings->font_path = $path;
            $settings->save();

            return back()->with('success', __(' successfully updated '));
        }

        return ValidationException::withMessages([
            'font' => __(' There is a problem with font uploading, call adminstrator... '),
        ]);
    }
}
