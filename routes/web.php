<?php

use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\ProfileController;
use App\Http\Livewire\Counter;
use App\Http\Livewire\ProfileComponent;
use App\Http\Livewire\SettingComponent;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth:sanctum', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {


    Route::prefix('profile')->group(function()
    {
        $profileClass = "App\Http\Livewire\Profile\\";
        Route::get('/', $profileClass.Index::class)->name('profile.index');
        Route::get('/show',$profileClass.Show::class)->name('profile.show');
    });

});

Route::get('login/{provider}',[SocialiteController::class,'redirectToProvider'])->name('social.login');
Route::get('login/{provider}/callback',[SocialiteController::class,'handleProviderCallback']);

Route::get('/setting',SettingComponent::class)->name('setting');


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
