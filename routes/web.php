<?php

use App\Aws\StorageCalculate;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\ProfileController;
use App\Http\Livewire\Invitation\Accept;
// use App\Http\Livewire\Issues\Search\Index;
use App\Http\Livewire\SettingComponent;
use App\Models\Status;
use App\Services\RouteRedirectService;
use App\Services\WorkspaceHelper;
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

Route::middleware(['auth','workspace.has','workspace.checkSelected'])->group(function () {

    //profile

    //workspace
    Route::middleware(['workspace.access'])->group(function () {
        Route::prefix('/workspaces/{workspace_name}')->group(function () {
            $workSpace = "App\Http\Livewire\Workspace\\";

            //profile
           Route::middleware(['workspace.checkMember'])->group(function(){
            Route::prefix('profile')->group(function()
            {
                $profileClass = "App\Http\Livewire\Profile\\";
                Route::get('/{email}', $profileClass.Index::class)->name('profile.index');
                Route::get('/{email}/show',$profileClass.Show::class)->name('profile.show');
                Route::post('/{email}/crop-image-store', [$profileClass.Show::class, 'saveCropped'])->name('saveCropped');
            });
           });

           //Search Section
            $IssueSearchClass = "App\Http\Livewire\Issues\Search\\";
            Route::get('/search',$IssueSearchClass.Index::class)->name('workspace.search.index');

            //Issue Section
            $issueClass = "App\Http\Livewire\Issues\\";
            Route::get('/issues',$issueClass.Index::class)->name('workspace.issue.index');
            Route::get('/issues/{slug}',$issueClass.Issue::class)->name('workspace.issue.show');
            Route::get('/create/issue/',$issueClass.Show::class)->name('workspace.issue.create');

            //setting Section
            Route::get('/',$workSpace.Index::class)->name('workspace.index');
            Route::get('/setting',$workSpace.'Setting\\'.Index::class)->name('workspace.setting.index');
            Route::get('/setting/members',$workSpace.'Setting\Member\\'.Index::class)->name('workspace.setting.member');
            Route::get('/setting/invite',$workSpace.'Setting\Member\\'.Invite::class)->name('workspace.setting.invite');
        });

    });
    Route::get('/dashboard', function () {
        // dd(session()->get('in_route'));

        return view('dashboard');
    })->name('dashboard');
    Route::get('/setting',SettingComponent::class)->name('setting');


});


Route::get('/sample',function()
{
        $issues = Status::select('id','title','color')
        ->with(['issues' => function($query){
            $query->select('id','title','description','status_id','creator_id','assign_id','due_date','created_at')
            ->where('workspace_id',6001)
            ->with('user:id,name,avatar,profile_photo_path,email');

        }])
        ->get();
   return $issues;
});

Route::get('/invitations/{invitationId}',Accept::class)->middleware(['auth','workspace.checkInvitation'])
->name('workspace.invitation');

$workSpace = "App\Http\Livewire\Workspace\\";
Route::get('/create/workspace',$workSpace.Create::class)->middleware('auth')->name('workspace.create');



Route::get('login/{provider}',[SocialiteController::class,'redirectToProvider'])->name('social.login');
Route::get('login/{provider}/callback',[SocialiteController::class,'handleProviderCallback'])
->middleware('workspace.invitation')->name('social.callback');



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
