<?php

namespace Modules\User\Space;

use Illuminate\Http\UploadedFile;
use Modules\User\Entities\Ad;
use Modules\User\Space\Contracts\StoresAdPicture;
use Str;

class StoreAdPicture implements StoresAdPicture
{

    private $path;

    public function store(UploadedFile $picture, Ad $ad): string
    {
        return $picture->store($this->getPath($ad));
    }

    public function getPath(Ad $ad)
    {

        $this->path = Str::of(config('user_directories.ads.picture'));

        return $this->path->replace(':user_id', auth()->id())->replace(':ad_id', $ad->id);
    }
}
