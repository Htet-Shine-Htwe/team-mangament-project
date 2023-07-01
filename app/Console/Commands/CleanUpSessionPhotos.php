<?php

namespace App\Console\Commands;

use App\Services\IssueCreateService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class CleanUpSessionPhotos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cleanup:session-photo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean the photo from session temp photo';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Cleaning up the session temp photo');

        $files = Storage::disk('local')->listContents('public/images/session_photo');

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
