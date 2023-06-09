<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


// Artisan::command('upload:cleanup',function()
// {
//     $this->info('Cleaning up the tmp files');
//     $files = Storage::disk('local')->listContents('livewire-tmp');

//     $totalFiles = collect($files)
//         ->filter(function($file){
//             return $file['lastModified'] < now()->subHours(5)->getTimestamp();
//         })
//         ->each(function($file){
//             Storage::disk('local')->delete($file['path']);
//         })->count();
//     // dump(count($files));
//     $this->info("$totalFiles files deleted successfully at " .now());
// })->purpose('Cleaning the tmp files');
