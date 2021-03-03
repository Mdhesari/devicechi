<?php

namespace Modules\Admin\Events;

use App\Menu\Builder\Builder;
use Illuminate\Queue\SerializesModels;

class BuildingMenu
{
    use SerializesModels;

    /**
     * The menu builder.
     *
     * @var Builder
     */
    public $menu;

    /**
     * The menu key to return from exsiting group menus
     *
     * @var string
     */
    public $key;

    /**
     * Create a new event instance.
     *
     * @param Builder $menu
     */
    public function __construct(Builder $menu, string $key)
    {
        $this->menu = $menu;
        $this->key = $key;
    }

    /**
     * Sanitize menu key
     *
     * @return void
     */
    public function getMenuKey()
    {
        return trim($this->key, '.');
    }
}
