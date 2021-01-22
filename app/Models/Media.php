<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends \Spatie\MediaLibrary\MediaCollections\Models\Media
{
    use HasFactory;

    protected $appends = [
        'url',
        'thumb_url'
    ];

    public function getUrlAttribute()
    {

        return $this->getFullUrl();
    }

    public function getThumbUrlAttribute()
    {

        return $this->getFullUrl('thumb');
    }
}
