<?php

namespace Modules\Core\Traits;

trait HasDomain
{
    
    /**
     * Get full sub domain
     *
     * @return void
     */
    private function getDomain()
    {

        return self::DOMAIN . '.' . config('app.url');
    }
}
