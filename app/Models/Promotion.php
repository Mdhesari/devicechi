<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'currency',
        'activate_after',
        'activate_after_type',
        'one_time',
        'admin_id',
        'order',
    ];
}
