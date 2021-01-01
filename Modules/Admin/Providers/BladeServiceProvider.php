<?php

namespace Modules\Admin\Providers;

use App\Space\Contracts\ScriptLoader;
use App\Space\Contracts\StyleLoader;
use App\Space\MainScriptLoader;
use App\Space\MainStyleLoader;
use Arr;
use Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View as ViewView;
use Log;
use Modules\Admin\View\Breadcrumb;
use Modules\Admin\View\BreadcrumbItem;
use Modules\Admin\View\ListGroupItems;
use Request;
use Route;
use View;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(StyleLoader::class, MainStyleLoader::class);
        $this->app->singleton(ScriptLoader::class, MainScriptLoader::class);
    }

    public function boot()
    {

        // Blade::componentNamespace('Modules\\Admin\\View', 'admin');
        Blade::component('breadcrumb-container', Breadcrumb::class);
        Blade::component('breadcrumb-item', BreadcrumbItem::class);
        Blade::component('list-group-array', ListGroupItems::class);

        Blade::if('route', function ($name) {

            $name = [$name];

            $is_route = false;

            foreach ($name as $value) {

                if (is_array($value)) {

                    foreach ($value as $child_val) {
                        Log::info($child_val);

                        if (Route::is($child_val)) $is_route = true;
                    }
                }

                if (Route::is($value)) $is_route = true;
            }

            return $is_route;
        });

        // compose user var to blade
        View::composer('admin::app', function (ViewView $view) {

            if (!$view->offsetExists('page_title'))
                $view->with([
                    'page_title' => __(' Dashboard '),
                ]);

            if (!$view->offsetExists('sidebar_nav'))
                $view->with([
                    'sidebar_nav' => config('admin_sidebar-nav.global'),
                ]);

            if ($user = request()->user())
                $view->with([
                    'user' => $user,
                ]);
        });

        // @styles
        Blade::directive('styles', function ($expression) {

            $styles = $this->renderStylesOrScripts(config("admin_styles"), $expression);

            $template = app(StyleLoader::class)->render($styles);

            return $template;
        });

        // @scripts
        Blade::directive('scripts', function ($expression) {
            $scripts = $this->renderStylesOrScripts(config("admin_scripts"), $expression);

            $template = app(ScriptLoader::class)->render($scripts);

            return $template;
        });
    }

    private function renderStylesOrScripts(array $config, $expression): array
    {
        if (empty($expression) || is_null($expression)) $expression = $config['default'];

        return $config ? $config[$expression] : [];
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
