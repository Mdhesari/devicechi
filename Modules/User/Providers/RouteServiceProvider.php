<?php

namespace Modules\User\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Modules\Core\Traits\HasDomain;
use Modules\User\Entities\PhoneBrand;
use Modules\User\Entities\PhoneModel;

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
        Route::model('phone_model', PhoneModel::class);
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {

        $this->parseDomainUrl(config('user.domain'), config('user.prefix'));

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
        Route::domain($this->getDomain())
            ->prefix($this->getPrefix() . '/api')
            ->name('user.api.')
            ->middleware('api')
            ->namespace($this->moduleNamespace)
            ->group(module_path('User', '/Routes/api/api.php'));

        Route::prefix('api')
            ->name('user.api.auth.')
            ->middleware(['api', 'auth.user:sanctum'])
            ->namespace($this->moduleNamespace)
            ->group(module_path('User', '/Routes/api/auth.php'));
    }
}
