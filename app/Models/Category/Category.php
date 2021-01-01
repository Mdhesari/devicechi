<?php

namespace App\Models\Category;

use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, NodeTrait;
    protected $parentString = '';
    protected $guarded = ['id', 'created_at', 'updated_at '];
    //-----------------Relations------------------//
    public function webinars()
    {
        return $this->belongsToMany('App\Models\Webinar\Webianr');
    }
    //-----------------Mutations------------------//
    public function getBreadcrumbAttribute()
    {
        $this->setParentString($this);
        return substr($this->parentString, 1);
    }

    public function setParentString($category)
    {
        $this->parentString = $this->parentString . '<' . $category->title;
        if($category->parent)
            $this->setParentString($category->parent);
    }
}
