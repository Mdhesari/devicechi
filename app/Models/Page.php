<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;

class Page extends Model
{
    use HasFactory, InteractsWithMedia, Sluggable;

    protected $fillable = [
        'title',
        'body',
        'slug',
        'excerpt',
        'meta',
        'template',
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'meta' => 'array',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['title'],
            ]
        ];
    }

    /**
     * getMetaTagTitleAttribute
     *
     * @return string|null
     */
    public function getMetaTagTitleAttribute()
    {
        return optional($this->meta)->tag_title;
    }

    /**
     * getMetaDescriptionAttribute
     *
     * @return string|null
     */
    public function getMetaDescriptionAttribute()
    {
        return optional($this->meta)->description;
    }

    /**
     * Get meta keywords
     *
     * @return array
     */
    public function getMetaKeywordsAttribute()
    {
        return optional($this->meta)->keywords ?: [];
    }

    public function getMetaPrintableKeywordsAttribute()
    {
        return join('.', $this->meta_keywords);
    }
}
