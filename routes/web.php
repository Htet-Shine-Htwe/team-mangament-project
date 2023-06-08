<?php

use App\Aws\StorageCalculate;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\ProfileController;
use App\Http\Livewire\SettingComponent;
use Aws\S3\S3Client;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users',[ProfileController::class,'users'])->name('users');

Route::middleware(['auth','workspace.has','workspace.checkSelected'])->group(function () {

    //profile
    Route::prefix('profile')->group(function()
    {
        $profileClass = "App\Http\Livewire\Profile\\";
        Route::get('/', $profileClass.Index::class)->name('profile.index');
        Route::get('/show',$profileClass.Show::class)->name('profile.show');
        Route::post('/crop-image-store', [$profileClass.Show::class, 'saveCropped'])->name('saveCropped');
    });


    //workspace
    Route::middleware(['workspace.access'])->group(function () {
        Route::prefix('/workspaces/{workspace_name}')->group(function () {
            $workSpace = "App\Http\Livewire\Workspace\\";
            $workSpaceSetting = "App\Http\Livewire\Workspace\Setting\\";
            Route::get('/',$workSpace.Index::class)->name('workspace.index');
            Route::get('/setting',$workSpaceSetting.Index::class)->name('workspace.setting.index');
        });

    });
    Route::get('/dashboard', function () {

        return view('dashboard');
    })->name('dashboard');
    Route::get('/setting',SettingComponent::class)->name('setting');


});


Route::get('/sample',function()
{
   return phpinfo();
});

    $workSpace = "App\Http\Livewire\Workspace\\";
    Route::get('/create/workspace',$workSpace.Create::class)->name('workspace.create');



Route::get('login/{provider}',[SocialiteController::class,'redirectToProvider'])->name('social.login');
Route::get('login/{provider}/callback',[SocialiteController::class,'handleProviderCallback']);



// Route::get('/test-s3-connection', function () {
//     $disk = Storage::disk('s3');
//     if ($disk->exists('9k.jpeg')) {
//         $image = Storage::disk('s3')->get('9k.jpeg');
//         return "<img src='{{$image}}' width=20 height=30 />";
//     } else {
//         return 'Failed to connect to S3.';
//     }
// });
require __DIR__.'/auth.php';
