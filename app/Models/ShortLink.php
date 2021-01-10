<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Str;

class ShortLink extends Model
{
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = ['code', 'link'];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($shortLink) {
            $shortLink->code = $this->createCode();
        });
    }

    private function createCode()
    {

        $code = Str::random(8);

        if ($this->whereCode($code)->count() > 0)
            $this->createCode();

        return $code;
    }

    public function getKeyName()
    {
        return 'code';
    }
}
