<?php

use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\ProfileController;
use App\Http\Livewire\Counter;
use App\Http\Livewire\ProfileComponent;
use App\Http\Livewire\SettingComponent;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
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
    Route::get('/profile', ProfileComponent::class)->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/counter',Counter::class);
});

Route::get('login/{provider}',[SocialiteController::class,'redirectToProvider'])->name('social.login');
Route::get('login/{provider}/callback',[SocialiteController::class,'handleProviderCallback']);

Route::get('/setting',SettingComponent::class)->name('setting');


require __DIR__.'/auth.php';
