<?php

namespace App\Console\Commands;

use App\Models\Ad;
use App\Models\Page;
use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;

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
        $generator = SitemapGenerator::create(config('app.url'))->getSitemap();

        foreach (Page::cursor() as $page) {
            $generator->add(
                Url::create(url($page->slug))
                    ->setLastModificationDate($page->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            );
        }

        foreach (Ad::cursor() as $ad) {
            $generator->add(
                Url::create(route('user.ad.show', $ad))
                    ->setLastModificationDate($ad->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            );
        }

        $generator->writeToFile(public_path('sitemap.xml'));
    }
}
