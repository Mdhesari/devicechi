<?php

namespace Modules\Admin\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Modules\Admin\Entities\Admin;
use Modules\Admin\Entities\User;
use Modules\Core\Traits\HasDomain;

class RouteServiceProvider extends ServiceProvider
{
    use HasDomain;
    /**
     * The module namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    protected $moduleNamespace = 'Modules\Admin\Http\Controllers';

    /**
     * Module domain
     *
     * @var mixed
     */
    protected $domain;

    /**
     * Module path if not subdomain
     *
     * @var mixed
     */
    protected $path;

    /**
     * Called before routes are registered.
     *
     * Register any model bindings or pattern based filters.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Route::bind('user', function ($value) {

            $isRoute = request()->routeIs([
                'admin.users.destroy',
                'admin.users.force-destroy',
                'admin.users.restore'
            ]);

            if ($isRoute)
                return User::withTrashed()->findOrFail($value);

            return User::findOrFail($value);
        });

        Route::bind('admin', function ($value) {

            $isRoute = request()->routeIs([
                'admin.admins.destroy',
                'admin.admins.force-destroy',
                'admin.admins.restore'
            ]);

            if ($isRoute)
                return Admin::withTrashed()->findOrFail($value);

            return Admin::findOrFail($value);
        });
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {

        $this->parseDomainUrl(config('admin.domain'), config('admin.prefix'));

        $this->mapApiRoutes();

        $this->mapWebRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::domain($this->getDomain())
            ->prefix($this->getPrefix())
            ->middleware('web')
            ->namespace($this->moduleNamespace)
            ->group(module_path('Admin', '/Routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    //TODO:domain must be read from config
    protected function mapApiRoutes()
    {
        Route::domain($this->getDomain())
            ->prefix($this->getPrefix() . '/api')
            ->middleware('api')
            ->namespace($this->moduleNamespace)
            ->group(module_path('Admin', '/Routes/api.php'));
    }
}
