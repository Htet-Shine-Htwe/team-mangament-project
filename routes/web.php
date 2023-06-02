<?php

use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\ProfileController;
use App\Http\Livewire\SettingComponent;

use Illuminate\Support\Facades\Route;


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

Route::middleware(['auth','workspace.has'])->group(function () {

    Route::prefix('profile')->group(function()
    {
        $profileClass = "App\Http\Livewire\Profile\\";
        Route::get('/', $profileClass.Index::class)->name('profile.index');
        Route::get('/show',$profileClass.Show::class)->name('profile.show');
        Route::post('/crop-image-store', [$profileClass.Show::class, 'saveCropped'])->name('saveCropped');
    });

    Route::middleware(['workspace.access','workspace.checkSelected'])->group(function () {
        Route::prefix('/workspaces/user/{workspace}')->group(function () {
            $workSpace = "App\Http\Livewire\Workspace\\";
            Route::get('/',$workSpace.Index::class)->name('workspace.index');
        });
    });

    Route::get('/setting',SettingComponent::class)->name('setting');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

});

Route::prefix('workspaces')->group(function()
{
    $workSpace = "App\Http\Livewire\Workspace\\";
    Route::get('/create',$workSpace.Create::class)->middleware('auth')->name('workspace.create');
});


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
