<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Benchmark;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {

});

Route::get('/pendingInvitations', function () {
    $workspaceId = request()->get('workspaceId');
    return response()->json([
        'data' =>  DB::table('invitations')
        ->select('invitations.id', 'invitations.email', 'invitations.status', 'invitations.created_at', 'invitations.updated_at')
        ->where('invitations.workspace_id', $workspaceId)
        ->where('invitations.status', 'pending')
        ->latest('invitations.id')
        ->paginate(4)
    ]);
});


Route::middleware(['workspace.has','workspace.checkSelected'])->group(function () {

    Route::middleware(['workspace.access'])->group(function () {
    });
});
Route::post('/issues/{id}',[\App\Http\Controllers\Api\Issues\IssueController::class,'update'])->name('issue.update');
Route::get('/issues',[\App\Http\Controllers\Api\Issues\IssueController::class,'index'])->name('issue.index');
