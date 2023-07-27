<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Menu extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name', 'key'
    ];

    public function items()
    {
        return $this->hasMany(MenuItem::class);
    }

    public function scopeIncludeItems($query)
    {
        return $query->with([
            'items' => function ($q) {
                $q->whereParentId(null);
            },
            'items.children'
        ]);
    }

    public static function scopefilterBasedOnRequest($query, Request $request)
    {
        $group  = $request->query('group', 'admin_sidebar');

        return $query->includeItems()->latest()->where('key', $group);
    }

    public function renderName()
    {

        return is_null($this->name) ? $this->key : $this->name;
    }
}
