<?php

namespace App\Space\Traits;

trait RegistersProviders
{

    /**
     * Registers module serviceProviders
     *
     * @param  mixed $providers
     * @return void
     */
    public function registerProviders(array $providers)
    {

        foreach ($providers as $provider) {

            $this->app->register($provider);
        }
    }
}
