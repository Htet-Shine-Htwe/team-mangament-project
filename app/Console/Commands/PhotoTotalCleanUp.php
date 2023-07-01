<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class PhotoTotalCleanUp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cleanUp:photos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Cleaning up the all tmp files');

        $this->call('cleanup:temporary-photo');
        $this->call('cleanup:session-photo');
        $this->info('The command was successful!');
        return Command::SUCCESS;
    }
}
