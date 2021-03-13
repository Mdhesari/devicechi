<?php

namespace App\Space;

use App\Helpers\MenuItemHelper;
use App\Menu\Builder;
use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Events\Dispatcher;
use Modules\Admin\Events\BuildingMenu;

class AdminLte
{
    /**
     * The array of menu items.
     *
     * @var array
     */
    protected $menu;

    /**
     * The array of menu filters. These filters will apply on each one of the
     * menu items in order to transforms they in some way.
     *
     * @var array
     */
    protected $filters;

    /**
     * The events dispatcher.
     *
     * @var Dispatcher
     */
    protected $events;

    /**
     * The application service container.
     *
     * @var Container
     */
    protected $container;

    /**
     * Map between a valid menu filter token and his respective filter method.
     * These filters are intended to get a specific set of menu items.
     *
     * @var array
     */
    protected $menuFilterMap;

    /**
     * Constructor.
     *
     * @param array $filters
     * @param Dispatcher $events
     * @param Container $container
     */
    public function __construct(array $filters, Dispatcher $events, Container $container)
    {
        $this->filters = $filters;
        $this->events = $events;
        $this->container = $container;

        // Fill the map of filters methods.

        // TODO-Remove get rid of menu filters
        // $this->menuFilterMap = [
        //     'sidebar'      => [$this, 'sidebarFilter'],
        //     'navbar-left'  => [$this, 'navbarLeftFilter'],
        //     'navbar-right' => [$this, 'navbarRightFilter'],
        //     'navbar-user'  => [$this, 'navbarUserMenuFilter'],
        // ];
    }

    /**
     * Get all the menu items, or a specific set of these.
     *
     * @param string $key which menu represented in exsiting menus
     * @return array A set of menu items
     */
    public function menu($key = 'admin.sidebar')
    {
        $this->menu = $this->buildMenu($key);

        return $this->menu;
    }

    /**
     * Build the menu.
     *
     * @param string $key the menu key exsiting in current menus group
     * @return array The set of menu items
     */
    protected function buildMenu(string $key)
    {
        // Create the menu builder instance.

        $builder = new Builder($this->buildFilters());

        // Dispatch the BuildingMenu event. Listeners of this event will fill
        // the menu.

        $this->events->dispatch(new BuildingMenu($builder, $key));

        // Return the set of menu items.

        return $builder->menu;
    }

    /**
     * Build the menu filters.
     *
     * @return array The set of filters that will apply on each menu item
     */
    protected function buildFilters()
    {
        return array_map([$this->container, 'make'], $this->filters);
    }

    /**
     * Filter method used to get the sidebar menu items.
     *
     * @param mixed $item A menu item
     * @return bool
     */
    private function sidebarFilter($item)
    {
        return MenuItemHelper::isSidebarItem($item);
    }
}
