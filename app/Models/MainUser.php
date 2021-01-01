<?php

namespace App\Models;

use App\Model\Payment\Discount;
use App\Model\Payment\Payment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Main\Database\Factories\UserFactory;
use Spatie\Permission\Traits\HasRoles;
use Storage;

class MainUser extends User
{
    use HasFactory, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = "users";

    /**
     * @param $value
     * @return string
     */
    public function getImageAttribute($value)
    {

       return is_null($value) ? asset('images/user.png') : Storage::url($value);
    }

    /**
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Translation\Translator|string|null
     */
    public function getMobileVerificationStatus()
    {

        return $this->mobile_verified_at ? __(' Active ') : __(' Pending ');
    }
    //-----------------Relations------------------//

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    public function discounts()
    {
        return $this->belongsToMany(Discount::class);
    }

    public function getInfoAttribute($value)
    {

        return $this->name . ' | ' . $this->mobile;
    }
}
