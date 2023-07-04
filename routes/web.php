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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Models\Issue as Is;


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
    $currentWorkspaceId = 6001;
            // $issues =  Status::select('statuses.id', 'statuses.title', 'statuses.color', 'i.id AS issue_id', 'i.title AS issue_title', 'i.status_id', 'i.creator_id', 'i.assign_id', 'i.created_at')
            // ->leftJoin('issues AS i', function ($join) {
            //     $join->on('statuses.id', '=', 'i.status_id')
            //         ->where('i.workspace_id', 6001);
            // })
            // ->whereIn('i.id', function ($query) {
            //     $query->select('id')
            //         ->from(function ($subquery) {
            //             $subquery->select('id', 'status_id', 'created_at')
            //                 ->from('issues')
            //                 ->whereRaw('status_id = statuses.id')
            //                 ->orderBy('created_at', 'desc')
            //                 ->limit(10);

            //         });
            // })
            // ->withCount('issues')
            // ->orderBy('statuses.id')
            // ->orderBy('i.created_at', 'desc')
            // ->get();

    $io = [];
   Status::select('id','title','color')->get()->each(function($status) use(&$io) {
   $status->issues=
            Is::select('id','title','status_id','creator_id','assign_id','created_at')
            ->where('status_id',$status->id)
            ->where('workspace_id',6001)
            ->with('user:id,name,avatar,profile_photo_path,email')
            ->orderBy("created_at",'desc')
            ->take(10)
            ->get();

    $io[] = $status;
        });


        return  Is::query()
        ->select('id', 'title', 'status_id', 'creator_id', 'assign_id', 'created_at')
        ->where('status_id', 16)
        ->where('workspace_id', $currentWorkspaceId)
        ->with('user:id,name,avatar,profile_photo_path')
        ->orderBy('created_at', 'desc')
        ->chunk(5, function ($issues) {
            foreach ($issues as $issue) {
                // Process each issue here
                $id = $issue->id;
                $title = $issue->title;
                $statusId = $issue->status_id;
                $creatorId = $issue->creator_id;
                $assignId = $issue->assign_id;
                $createdAt = $issue->created_at;

                // Access related user data
                $user = $issue->user;
                $userId = $user->id;
                $userName = $user->name;
                $userAvatar = $user->avatar;
                $userProfilePhotoPath = $user->profile_photo_path;

                // Perform any required operations or computations on the issue and user data
            }
        });
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
