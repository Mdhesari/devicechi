<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Storage;

class AdPicture extends Model
{
    use HasFactory;

    protected $table = 'ad_pictures';

    protected $fillable = ['ad_id', 'url', 'meta_picture'];

    public function getUrlAttribute($url)
    {

        return Storage::url($url);
    }
}
