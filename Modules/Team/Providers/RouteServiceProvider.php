<?php

namespace Modules\Team\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Modules\Core\Traits\HasDomain;

class RouteServiceProvider extends ServiceProvider
{

    use HasDomain;

    const DOMAIN = 'team';

    /**
     * The module namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    protected $moduleNamespace = 'Modules\Team\Http\Controllers';

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
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->parseDomainUrl(config('team.domain'), config('team.prefix'));

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
            ->group(module_path('Team', '/Routes/domain/web.php'));

        Route::domain(config('app.url'))
            ->middleware('web')
            ->namespace($this->moduleNamespace)
            ->group(module_path('Team', '/Routes/web.php'));

        // fortify
        Route::domain($this->getDomain())
            ->prefix($this->getPrefix())
            ->middleware(config('fortify.middleware', ['web']))
            ->namespace($this->moduleNamespace)
            ->group(module_path('Team', '/Routes/domain/fortify/routes.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->moduleNamespace)
            ->group(module_path('Team', '/Routes/api.php'));
    }
}
