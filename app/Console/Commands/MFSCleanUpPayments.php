<?php

namespace App\Console\Commands;

use App\Models\Payment\Payment;
use Illuminate\Console\Command;

class MFSCleanUpPayments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mfs:clear-payments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        Payment::where('id', '>', 0)->delete();
    }
}
