<?php

namespace Modules\User\Console\Curl;

use Artisan;
use Goutte\Client;
use Illuminate\Console\Command as BaseCommand;
use Log;
use App\Models\PhoneBrand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\File\Exception\UploadException;

use function PHPUnit\Framework\directoryExists;

class Command extends BaseCommand
{

    /**
     * client request
     *
     * @var Symfony\Component\HttpClient\HttpClient
     */
    protected $cli;

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
}
