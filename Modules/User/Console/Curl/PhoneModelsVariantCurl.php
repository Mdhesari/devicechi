<?php

namespace Modules\User\Console\Curl;

use ArithmeticError;
use Artisan;
use Goutte\Client;
use Illuminate\Console\Command;
use Log;
use Modules\User\Entities\PhoneModel;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
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

        $models = PhoneModel::with('brand')->get();

        if (count($models) < 1) {

            $this->error('There is no models available!');
            Log::error('No models available...');
            return 0;
        }

        $db_data = [];

        foreach ($models as $model) {

            $response = $this->cli->request('GET', $url . $model->brand->name . '/' . $model->name);

            $response->filter('.dev-details .cards2 .card')->each(function ($node) use (&$db_data, $model) {

                $ramAndStorage = explode('/', $node->text());

                $ram = $ramAndStorage[0];
                $storage = $ramAndStorage[1];

                $db_data[] = [
                    'model' => $model->name,
                    'ram' => $ram,
                    'storage' => $storage,
                ];
            });
        }

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
}
