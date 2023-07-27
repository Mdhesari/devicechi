<?php

namespace Modules\User\Providers;

use App\Models\Ad;
use App\Providers\AuthServiceProvider;
use Modules\User\Policies\AdPolicy;

class UserAuthServiceProvider extends AuthServiceProvider
{

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Ad::class => AdPolicy::class,
    ];
}
