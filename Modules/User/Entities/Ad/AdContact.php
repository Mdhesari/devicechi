<?php

namespace Modules\User\Entities\Ad;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\User\Entities\Ad;

class AdContact extends Model
{
    use HasFactory;

    protected $fillable = ['value', 'data'];

    protected $casts = [
        'data' => 'array',
    ];

    public function ad()
    {

        return $this->belongsTo(Ad::class);
    }
}
