<?php
namespace App\Casts;

use App;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class CustomDateCast implements CastsAttributes
{
        /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     *
     * @return Carbon|mixed
     */
    public function get($model, string $key, $value, array $attributes)
    {
        if(App::isLocale('fa') && $value) {
            
            return verta($value);
            
        }
        return $value;
    }
        
    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     *
     * @return array|Carbon|string
     */
    public function set($model, string $key, $value, array $attributes)
    {
        return $value;
    }
}