<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\User\Database\Factories\AdPictureFactory;
use Storage;

class AdPicture extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $table = 'ad_pictures';

    protected $fillable = ['ad_id', 'url', 'meta_picture', 'is_active'];

    public function getUrlAttribute($url)
    {

        $urlArr = parse_url($url);

        if (isset($urlArr['scheme'])) return $url;

        return Storage::url($url);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return new AdPictureFactory;
    }
}
