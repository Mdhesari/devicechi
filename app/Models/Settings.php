<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

abstract class Settings extends \Spatie\LaravelSettings\Settings
{
    abstract static function group(): string;
}
