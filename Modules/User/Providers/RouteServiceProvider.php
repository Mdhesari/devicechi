<?php

namespace Modules\User\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Modules\Core\Traits\HasDomain;
use Modules\User\Entities\PhoneBrand;

class RouteServiceProvider extends ServiceProvider
{

    use HasDomain;

    const DOMAIN = 'my';

    /**
     * The module namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    protected $moduleNamespace = 'Modules\User\Http\Controllers';

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

        Route::model('phone_brand', PhoneBrand::class);
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
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
            ->middleware('web')
            ->namespace($this->moduleNamespace)
            ->group(module_path('User', '/Routes/domain/web.php'));

        Route::domain(config('app.url'))
            ->middleware('web')
            ->namespace($this->moduleNamespace)
            ->group(module_path('User', '/Routes/web.php'));
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
            ->group(module_path('User', '/Routes/api.php'));
    }
}
