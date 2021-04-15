<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Page extends Model implements HasMedia
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

    public function getAvailableMetaKeys()
    {
        return [
            'tag_title', 'description', 'keywords'
        ];
    }

    /**
     * getMetaTagTitleAttribute
     *
     * @return string|null
     */
    public function getMetaTagTitleAttribute()
    {
        return optional($this->meta)['tag_title'] ?: '';
    }

    /**
     * getMetaDescriptionAttribute
     *
     * @return string|null
     */
    public function getMetaDescriptionAttribute()
    {
        return optional($this->meta)['description'] ?: '';
    }

    /**
     * Get meta keywords
     *
     * @return array
     */
    public function getMetaKeywordsAttribute()
    {
        return optional($this->meta)['keywords'] ?: [];
    }

    public function getMetaPrintableKeywordsAttribute()
    {
        return join('.', $this->meta_keywords);
    }

    public function updateMeta($data)
    {
        $keys = $this->getAvailableMetaKeys();

        $data = array_filter($data, fn ($item, $key) => !is_null($item) && in_array($key, $keys), ARRAY_FILTER_USE_BOTH);

        if (isset($data['keywords'])) {
            $data['keywords'] = explode('.', $data['keywords']);
        }

        $this->meta = $data;
        $this->update();
    }

    public function renderName()
    {
        return $this->title . ' : ' . $this->slug;
    }
}
