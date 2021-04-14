<?php

namespace App\Console\Commands;

use Artisan;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Console\Command;
use Modules\Admin\Database\Seeders\RoleTableSeeder;

class MFSRunRoleSeeder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mfs:roles';

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
        $this->info('Start seeding...');

        app(DatabaseSeeder::class)->call(
            RoleTableSeeder::class,
        );

        $this->info('the end...');
    }
}
