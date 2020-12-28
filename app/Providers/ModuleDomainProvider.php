<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\HasDomain;
use Request;

class ModuleDomainProvider extends ServiceProvider
{
    use HasDomain;
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        $provider = $this;

        Request::macro('isModuleDomain', function ($domain = null, $prefix = '/') use ($provider) {
            $current = parse_url($this->fullUrl());

            $module = $provider->parseDomainUrl($domain, $prefix);
            if ($current['host'] == $module['domain']) {

                return $this->is($module['path'] . '/*');
            }

            return false;
        });
    }
}
