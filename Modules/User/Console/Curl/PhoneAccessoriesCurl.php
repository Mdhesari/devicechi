<?php

namespace Modules\User\Console\Curl;

use Artisan;
use Log;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\HttpFoundation\File\Exception\UploadException;

class PhoneAccessoriesCurl extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'curl:phone_accessories {type=log} {--url=https://www.recycledevice.com/sell/apple-iphone-xr-64gb}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Curl all accessories on db or log';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $url = $this->option('url');
        $type = $this->argument('type');

        $this->info('Start scrapping accessories...');

        $response = $this->cli->request('GET', $url);

        $accessories = [];

        $response->filter('.question[data-name="accessories"] .card .card-title')->each(function ($node) use (&$accessories) {
            $accessories[]['title'] = $node->text();
        });

        $i = 0;

        $response->filter('.question[data-name="accessories"] .card .card-wrap img')->each(function ($node) use (&$i, &$accessories) {

            $url = $node->attr('src');
            $info = pathinfo($url);

            $dir = 'assets/accessories/';

            $path = $dir . $info['basename'];

            $full_path = public_path($path);

            if (!file_exists($full_path)) {

                if (!is_dir(public_path($dir))) {

                    exec('mkdir ' . public_path($dir));
                }

                $result = $this->saveImage($full_path, $url);

                if (!$result) throw new UploadException;
            }

            $accessories[$i]['picture_path'] = $path;

            $i++;
        });

        if ($type == 'database') {

            config([
                'user.phone_accessories' => $accessories,
            ]);

            Artisan::call('module:seed User --class=PhoneAccessoriesTableSeeder');

            Log::info($accessories);
        } else {

            file_put_contents(predata_path('/accessories.json'), json_encode($accessories));

            Log::info($accessories);
        }

        $this->info('Successfuly scrapped accessories...');
    }


    private function saveImage($src, $url)
    {
        return file_put_contents($src, file_get_contents($url));
    }
}
