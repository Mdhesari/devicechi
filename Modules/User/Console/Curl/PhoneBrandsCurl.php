<?php

namespace Modules\User\Console\Curl;

use Artisan;
use Goutte\Client;
use Log;
use App\Models\PhoneBrand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\File\Exception\UploadException;

use function PHPUnit\Framework\directoryExists;

class PhoneBrandsCurl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'curl:phone_brands {type=log} {--url=https://www.recycledevice.com/sell-mobile}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Curl all brands and store on db or log';


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $url = $this->option('url');

        $response = $this->cli->request('GET', $url);

        $this->info('Start scrapping... ' . $url . ' url.');

        // $this->storeItems($response);

        $this->storeImages($response);

        $this->info('Successfully scrapped data and resources.');
    }

    private function storeItems($response)
    {

        $this->info('Srapping items...');

        $type = $this->argument('type');

        $brands = [];

        $response->filter('.brand-list .item')->each(function ($node) use (&$brands) {

            $brands[] = $node->text();
        });

        if ($type == 'database') {

            config([
                'user.phone_brands' => $brands,
            ]);

            $this->info('Running module:seed artisan command...');

            Artisan::call('module:seed User --class=PhoneBrandTableSeeder');
        } else {

            Log::info($brands);
        }
    }

    private function storeImages($response)
    {

        $this->info('scrapping item images...');

        $type = $this->argument('type');

        $brands = [];

        $response->filter('.brand-list .item img')->each(function ($node) use (&$brands) {

            $url = $node->attr('src');
            $info = pathinfo($url);

            $brand = $info['filename'];

            $dir = 'assets/brands/';

            $path = $dir . $info['basename'];

            $file = public_path($path);

            if (!file_exists($file)) {

                if (!is_dir(public_path($dir))) {

                    exec('mkdir ' . public_path($dir));
                }

                $result = $this->saveImage($file, $url);

                if (!$result) throw new UploadException();
            }

            $brands[] = [
                'name' => $brand,
                'picture_path' => $path
            ];
        });

        if ($type == 'database') {

            config([
                'user.phone_brands_image' => $brands,
            ]);

            $this->info('Running module:seed artisan command...');

            Artisan::call('module:seed User --class=PhoneBrandImageTableSeeder');

            Log::info(PhoneBrand::all()->toArray());
        } else {

            file_put_contents(predata_path('/brands.json'), json_encode($brands));

            Log::info($brands);
        }
    }

    private function saveImage($src, $url)
    {
        return file_put_contents($src, file_get_contents($url));
    }
}
