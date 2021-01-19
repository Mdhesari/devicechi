<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\ShortLinkController;
use Modules\Admin\Space\ImageFilters\InstagramFilter;

Route::get('/try', function () {

    $user_img = Storage::path('images/1.jpg');

    // $canvas = Image::make($user_img)->resize(1080, 1080);

    $template = public_path('images/template-1.png');

    // $canvas
    //     ->blur(95)
    //     ->insert($user_img, 'top-center')
    //     ->insert(public_path('images/template-1.png'))
    //     ->text("Iphone \nhi", 540, 540, function ($font) {
    //         $font->file(public_path('fonts/Open_Sans/OpenSans-Regular.ttf'));
    //         $font->size(124);
    //         $font->color('#f1f2f3');
    //         $font->align('center');
    //         $font->valign('center');
    //     })
    //     ->save('test.jpg');

    $image = Image::make($user_img)->filter(new InstagramFilter(

        Str::of("iphone")
            ->append("\n")
            ->append("77"),
        $template
    ))->save('test.jpg');

    return $image;
});

Route::get('p/{code}', [ShortLinkController::class, 'show'])->name('shortlink');
