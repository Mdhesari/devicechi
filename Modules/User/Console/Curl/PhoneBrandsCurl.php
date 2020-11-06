<?php

namespace Modules\User\Console\Curl;

use Goutte\Client;
use Illuminate\Console\Command;
use Log;
use Modules\User\Entities\PhoneBrand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\File\Exception\UploadException;

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
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->cli = new Client(HttpClient::create(['timeout' => 60]));

        parent::__construct();
    }

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

        $this->storeItems($response);

        $this->storeImages($response);

        $this->info('Successfully scrapped data and resources.');
    }

    private function storeItems($response)
    {

        $this->info('scrapping items...');

        $type = $this->argument('type');

        $brands = [];

        $response->filter('.brand-list .item')->each(function ($node) use (&$brands) {

            $brands[] = $node->text();
        });

        if ($type == 'database') {

            config([
                'user.phone_brands' => $brands,
            ]);

            $this->call("module:seed User --class=PhoneBrandTableSeeder");

            Log::info(PhoneBrand::all());
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

            $path = 'images/brands/' . $info['basename'];

            $file = public_path($path);

            if (!file_exists($file)) {

                $result = $this->saveImage($file, $url);

                if (!$result) throw new UploadException();
            }

            $brands[] = [
                'name' => $brand,
                'picture_path' => $path
            ];
        });

        if ($type == 'database') {

            $this->info('db scrap images');
        } else {

            Log::info($brands);
        }
    }

    private function saveImage($src, $url)
    {
        return file_put_contents($src, file_get_contents($url));
    }

    // /**
    //  * Get the console command arguments.
    //  *
    //  * @return array
    //  */
    // protected function getArguments()
    // {
    //     return [
    //         ['example', InputArgument::REQUIRED, 'An example argument.'],
    //     ];
    // }

    // /**
    //  * Get the console command options.
    //  *
    //  * @return array
    //  */
    // protected function getOptions()
    // {
    //     return [
    //         ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
    //     ];
    // }
}
