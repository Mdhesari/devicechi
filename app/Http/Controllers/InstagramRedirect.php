<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstagramRedirect extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        if (strpos($userAgent, 'Instagram')) {
            $file = \fopen('instagram.txt', 'wr');
            header('Content-type: application/pdf');
            header('Content-Disposition: inline; filename= blablabla');
            header('Content-Transfer-Encoding: binary');
            header('Accept-Ranges: bytes');
            @readfile($file);
            fclose($file);
        } else {
            return redirect()->route('user.home');
        }
    }
}
