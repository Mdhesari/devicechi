<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuItem;
use App\Space\MenuItemFactory;
use Exception;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = config('adminlte.menu');

        $menuItemFactory = app(MenuItemFactory::class);

        foreach ($menus as $key => $items) {
            $menu = Menu::create([
                'key' => $key,
            ]);

            $menuItemFactory->buildAndStoreMenuItems($menu, $items);
        }
    }
}
