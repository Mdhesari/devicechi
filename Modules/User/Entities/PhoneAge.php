<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PhoneAge extends Model
{
    protected $fillable = ['from', 'to', 'type'];

    protected $appends = ['printableName'];

    public function getPrintableNameAttribute()
    {
        $txt = '';

        if ($this->from == '-') {
            $txt = __('user::ads.form.label.age.min', [
                'month' => $this->to
            ]);
        } else if ($this->to == '+') {
            $txt = __('user::ads.form.label.age.max', [
                'month' => $this->from
            ]);
        } else {
            $txt = __('user::ads.form.label.age.between', [
                'min' => $this->from,
                'max' => $this->to
            ]);
        }

        return $txt;
    }
}
