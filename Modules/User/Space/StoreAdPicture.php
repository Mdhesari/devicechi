<?php

namespace Modules\User\Space;

use File;
use Illuminate\Http\UploadedFile;
use Log;
use App\Models\Ad;
use Modules\User\Space\Contracts\StoresAdPicture;
use Storage;
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

    public function deleteStoredPicture($url)
    {
        if (Storage::exists($url)) {

            return Storage::delete($url);
        }

        return false;
    }
}
