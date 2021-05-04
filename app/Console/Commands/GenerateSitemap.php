<?php

namespace App\Console\Commands;

use App\Models\Ad;
use App\Models\Page;
use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate sitemap for website.';

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
        $generator = SitemapGenerator::create(config('app.url'));

        foreach (Page::cursor() as $page) {
            $generator->add(url($page->slug));
        }

        foreach (Ad::cursor() as $ad) {
            $generator->add(route('user.ad.show', $ad));
        }

        $generator->writeToFile(public_path('sitemap.xml'));
    }
}
