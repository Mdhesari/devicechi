<?php

namespace App\Models\Payment;

use Illuminate\Database\Eloquent\Model;
use Modules\Main\Entities\User\User;

class Discount extends Model
{
    protected $fillable = [];
    //-----------------Relations------------------//
    public function type()
    {
        return $this->belongsTo(DiscountType::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
