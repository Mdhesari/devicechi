<?php

namespace Modules\User\Space\Contracts;

use Illuminate\Http\UploadedFile;
use Modules\User\Entities\Ad;

interface StoresAdPicture
{

    /**
     * Store ad pciture
     *
     * @param  mixed $picture
     * @return void
     */
    public function store(UploadedFile $picture, Ad $ad): string;
}
