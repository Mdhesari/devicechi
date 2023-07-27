<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'text', 'header', 'permission', 'class', 'route', 'route_params', 'url', 'icon_color', 'sort', 'icon',
        'parent_id', 'target',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'route_params' => 'array'
    ];

    public function children()
    {
        return $this->hasMany(MenuItem::class, 'parent_id');
    }
}
