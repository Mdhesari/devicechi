<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model implements HasMedia
{
    use HasFactory,
        Sluggable,
        InteractsWithMedia;

    protected $fillable = [
        'title',
        'body',
        'slug',
        'excerpt',
        'meta',
    ];

    const MEDIA_FEATURED_IMAGE = 'featured_image';

    const STATUS_LIST = [
        'archived', // 0
        'published' // 1
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'meta' => 'array',
        'status' => 'int',
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
            ],
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
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

    /**
     * Get meta keywords
     *
     * @return array
     */
    public function getMetaFeaturedImageUrlAttribute()
    {
        $image = $this->getMedia(static::MEDIA_FEATURED_IMAGE)->first();

        if (is_null($image)) {
            return false;
        }

        return $image->getFullUrl();
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

    public function updateStatus($status)
    {
        if (!in_array(intval($status), array_keys(static::STATUS_LIST))) {
            return false;
        }

        $this->forceFill([
            'status' => $status,
        ])->save();
    }

    public function getAvailableMetaKeys()
    {
        return [
            'tag_title', 'description', 'keywords', 'is_favourite'
        ];
    }

    public function getIsFavouriteAttribute()
    {
        return optional($this->meta)['is_favourite'] ?: false;
    }

    public static function getStatusList()
    {
        $list = [];

        foreach (static::STATUS_LIST as $key => $value) {
            $list[] = [
                'title' => __(" $value "),
                'value' => intval($key),
            ];
        }

        return $list;
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(static::MEDIA_FEATURED_IMAGE);
    }
}
