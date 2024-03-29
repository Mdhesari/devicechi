<?php

namespace Modules\User\Console\Curl;

use Artisan;
use Goutte\Client;
use Log;
use App\Models\PhoneBrand;
use Modules\User\Entities\PhoneModel;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\HttpClient\HttpClient;

class PhoneModelsCurl extends Command
{
    /**
     * The console command singature.
     *
     * @var string
     */
    protected $signature = 'curl:phone_models {type=log} {--url=https://www.recycledevice.com/sell-mobile/}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Curl all phone models and store on db or log.';

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

        $this->storeItems($url, $type);

        $this->info('Scrapping was successful!');
    }

    private function storeItems($url, $type)
    {

        $brands = PhoneBrand::all();

        if (count($brands) < 1) {

            $this->error('There is no brands available!');
            return 0;
        }

        $db_models = [];

        $this->info('Start scrapping phone brand items');

        foreach ($brands as $brand) {

            $response = $this->cli->request('GET', $url . $brand->name);

            $response->filter('.device-list .item')->each(function ($node) use ($brand, &$db_models) {

                $model = $node->text();

                $db_models[] = [
                    'brand_name' => $brand->name,
                    'name' => $model,
                ];
            });
        }

        if ($type == 'database') {

            config([
                'user.phone_models' => $db_models,
            ]);

            Artisan::call('module:seed User --class=PhoneModelTableSeeder');
        } else {

            file_put_contents(predata_path('/models.json'), json_encode($db_models));

            Log::info($db_models);
        }
    }
}
