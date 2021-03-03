<?php

namespace App\Space;

use App\Models\Menu;
use Exception;

class MenuItemFactory
{

    /**
     * Build menu items
     *
     * @param  Menu $menu
     * @param  array $data
     * @return void
     */
    public function buildAndStoreMenuItems(Menu $menu, array $items)
    {
        foreach ($items as $item) {
            $this->storeMenuItem($menu, $item);
        }
    }

    /**
     * Store menu items in db
     *
     * @param  mixed $menu
     * @param  mixed $item
     * @param  mixed $parent_id
     * @return void
     */
    private function storeMenuItem(Menu $menu, array $item, $parent_id = null)
    {
        $item_data = array_merge($item, compact('parent_id'));

        // in order to prevent str exception of array to string conversion we need to get rid of submenu for item data

        $item_data = array_filter($item_data, function ($key) {
            return $key != 'submenu';
        }, ARRAY_FILTER_USE_KEY);

        $item_db = $menu->items()->create($item_data);

        if (!$item_db) {
            throw new Exception(' Menu item is not created in db.');
        }

        if (isset($item['submenu'])) {
            $parent_id = $item_db->id;
            foreach ($items = $item['submenu'] as $child) {
                $this->storeMenuItem($menu, $child, $parent_id);
            }
        }
    }
}
