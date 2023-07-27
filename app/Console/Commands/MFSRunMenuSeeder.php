<?php

namespace App\Console\Commands;

use App\Models\Menu;
use App\Models\MenuItem;
use Database\Seeders\DatabaseSeeder;
use Database\Seeders\MenuSeeder;
use Illuminate\Console\Command;

class MFSRunMenuSeeder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mfs:menus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->call('optimize:clear');

        $this->info(sprintf('Deleting %s menus and %s menu items...', Menu::count(), MenuItem::count()));

        MenuItem::truncate();
        Menu::truncate();

        $this->info('Start seeding...');

        app(DatabaseSeeder::class)->call(
            MenuSeeder::class,
        );

        $this->info('the end...');
    }
}
