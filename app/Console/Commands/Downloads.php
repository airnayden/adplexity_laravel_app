<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Downloads extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'downloads:index';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Lists all file download tasks, along with useful data about their statuses.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return Command::SUCCESS;
    }
}
