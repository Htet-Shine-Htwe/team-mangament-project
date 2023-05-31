<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class CleanUpTemporaryPhoto extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'upload:cleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cleaning the tmp files';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Cleaning up the tmp files');
        $files = Storage::disk('local')->listContents('livewire-tmp');

        $totalFiles = collect($files)
            // ->filter(function($file){
            //     return $file['lastModified'] < now()->subHours(5)->getTimestamp();
            // })
            ->each(function($file){
                Storage::disk('local')->delete($file['path']);
            })->count();
        // dump(count($files));
         $this->info("$totalFiles files deleted successfully at " .now());
        return Command::SUCCESS;
    }
}
