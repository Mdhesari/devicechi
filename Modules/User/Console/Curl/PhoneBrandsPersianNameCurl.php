<?php

namespace Modules\User\Console\Curl;

use Log;
use App\Models\PhoneBrand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class PhoneBrandsPersianNameCurl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'curl:phone_persian_brands {type=log} {--url=https://www.mobile.ir/brands/index.aspx}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';

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
     * @return mixed
     */
    public function handle()
    {
        $url = $this->option('url');

        $response = $this->cli->request('GET', $url);

        $brands = [];

        $response->filter('.padd .brands [href]')->each(function ($node) use (&$brands) {

            $title = explode('/', $node->attr('title'));

            if (isset($title[1]))
                $brands[trim($title[0])] = $title[1];
        });

        foreach (PhoneBrand::cursor() as $main) {

            foreach ($brands as $key => $value) {
                if ($main->name == $key) {

                    $main->persian_name = $value;
                    $main->save();
                    break;
                }
            }
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['example', InputArgument::REQUIRED, 'An example argument.'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }
}
