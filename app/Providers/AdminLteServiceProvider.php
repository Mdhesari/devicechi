<?php

namespace App\Providers;

use App\Composer\AdminLteComposer;
use App\Http\Resources\MenuItemsResource;
use App\Models\Menu;
use App\Space\AdminLte;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Modules\Admin\Events\BuildingMenu;
use Str;

class AdminLteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Bind a singleton instance of the AdminLte class into the service
        // container.

        $this->app->singleton(AdminLte::class, function (Container $app) {
            return new AdminLte(
                $app['config']['adminlte.filters'],
                $app['events'],
                $app
            );
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Factory $view, Dispatcher $events, Repository $config)
    {
        $this->registerViewComposers($view);
        $this->registerMenu($events, $config);
    }

    /**
     * Register the package's view composers.
     *
     * @return void
     */
    private function registerViewComposers(Factory $view)
    {
        $view->composer(config('admin.layout', 'app', 'page'), AdminLteComposer::class);
    }

    /**
     * Register the menu events handlers.
     *
     * @return void
     */
    private static function registerMenu(Dispatcher $events, Repository $config)
    {
        // Register a handler for the BuildingMenu event, this handler will add
        // the menu defined on the config file to the menu builder instance.
        $events->listen(
            BuildingMenu::class,
            function (BuildingMenu $event) use ($config) {
                //TODO get rid of getting config when event
                // $menu = $config->get('adminlte.menu.' . $key, []);
                $key = $event->getMenuKey();
                // menu cache will be removed after any update

                $items = cache()->rememberForever(get_cache_menu_full_key($key), function () use ($key) {
                    $menu = Menu::includeItems()->latest()->where('key', $key)->first();
                    return MenuItemsResource::collection($menu->items)->toArray(app(Request::class));
                });

                $items = is_array($items) ? $items : [];
                $event->menu->add(...$items);
            }
        );
    }
}
