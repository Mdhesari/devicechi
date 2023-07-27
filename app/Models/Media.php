<?php

namespace App\Models;

use Exception;
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
        try {
            return $this->getFullUrl('thumb');
        } catch (Exception $e) {
            return '';
        }
    }

    public function scopeActiveOnly($query)
    {

        return $query->where('custom_properties->active', true);
    }
}
