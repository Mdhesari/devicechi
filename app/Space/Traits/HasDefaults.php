<?php

namespace App\Space\Traits;

use Exception;

trait HasDefaults
{
    /**
     * setDefaultsAttribute
     *
     * @param  mixed $value
     * @return void
     */
    public function setDefaultsAttribute($value)
    {
        $this->attributes['defaults'] = $value;
    }

    public function getSelected()
    {
        return $this->defaults ? in_array($this->id, $this->defaults) : false;
    }
}
