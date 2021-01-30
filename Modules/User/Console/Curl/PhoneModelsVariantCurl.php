<?php

namespace Modules\User\Console\Curl;

use Artisan;
use Goutte\Client;
use Log;
use App\Models\PhoneBrand;
use Symfony\Component\HttpClient\HttpClient;

class PhoneModelsVariantCurl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'curl:phone_variants {type=log} {--url=https://www.recycledevice.com/sell-mobile/}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Curl all model variants and store on db or log';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->cli = new Client(HttpClient::create(['timeout' => 60]));
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $url = $this->option('url');
        $type = $this->argument('type');

        $this->info('Start scrapping phone models data and resources...');

        $this->storageRamAndStorage($url, $type);

        $this->info('Scrapping was successful!');
    }

    private function storageRamAndStorage($url, $type)
    {

        $model_urls = $this->getModelsUrl($url);

        if (count($model_urls) < 1) {

            $this->error('There is no models available!');
            Log::error('No models available...');
            return 0;
        }

        $db_data = [];

        foreach ($model_urls as $data) {

            $url = "https://www.recycledevice.com/" . trim($data['url'], "/");

            $model = $data['model'];

            $this->info($url);

            $response = $this->cli->request('GET', $url);

            $response->filter('.dev-details .cards2 .card')->each(function ($node) use (&$db_data, $model) {
                $ramAndStorage = explode('/', $node->text());

                $ram = $ramAndStorage[0];
                $storage = $ramAndStorage[1];

                $db_data[] = [
                    'model' => $model,
                    'ram' => $ram,
                    'storage' => $storage,
                ];
            });
        }

        file_put_contents(public_path() . '/variants.json', json_encode($db_data));

        if ($type == 'database') {

            config([
                'user.phone_variants' => $db_data,
            ]);

            Artisan::call('module:seed User --class=PhoneModelVariantsTableSeeder');

            Log::info($db_data);
        } else {

            Log::info($db_data);
        }
    }

    private function getModelsUrl($url)
    {


        $brands = PhoneBrand::all();

        $bar = $this->output->createProgressBar($brands->count());

        if (count($brands) < 1) {

            $this->error('There is no brands available!');
            return 0;
        }

        $bar->start();

        $this->info('Start scrapping phone brand items');

        $urls = [];

        foreach ($brands as $brand) {

            $response = $this->cli->request('GET', $url . $brand->name);

            $response->filter('.device-list .item a')->each(function ($node) use (&$urls, $brand) {

                $urls[] = [
                    'url' => $node->attr('href'),
                    'model' => $node->text(),
                ];
            });

            $bar->advance();
        }

        $bar->finish();

        return $urls;
    }
}
