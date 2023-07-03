<?php

namespace App\Services;

use App\Jobs\SendIssueCreatedMail;
use App\Mail\IssueCreatedMail;
use App\Models\Issue;
use App\Models\IssuePhoto;
use App\Models\User;
use App\Notifications\IssueCreated;
use App\Storage\S3FileStorage;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class IssueCreateService
{

    public function __construct(protected readonly S3FileStorage $storage)
    {

    }

    public static function create($data, $files = null)
    {

        if(isset($data['due_date']))
        {
            $dateString = $data['due_date'];

            if(!$dateString instanceof DateTime)
            {
                $date = Carbon::createFromFormat('d/m/Y', $dateString)->toDate();
                $data['due_date'] = $date;
            }
        }

        self::fullIssueProcess($data,$files);

        return redirect()->route('workspace.issue.index',['workspace_name' => getCurrentWorkspaceName()]);
    }

    protected static function fullIssueProcess(array $data , $files = null) :void
    {
        $issue = self::createIssue($data);

        if(isset($files))
        {
            self::saveImages($files,$issue);
            self::deleteSessionImage();
        }
        // self::sendNotification($issue,$data);
        session()->forget('old_issue_create');
    }

    protected static function saveImages($files,$issue)
    {
        $uploadedFiles = [];
        if(isset($files)){
            try{
                $uploadedFiles = (new S3FileStorage)->storePhotos($files,'issues');
                $images = [];
                forEach($uploadedFiles as $file)
                {
                    $images[] = [
                        'path' => $file,
                        'issue_id' => $issue->id
                    ];
                }
                IssuePhoto::insert($images);

            }
           catch(\Exception $e)
           {
                return  "image Saving error " . $e->getMessage();
           }
    }
    }
    public static function deleteSessionImage()
    {
        $sessionData = session()->get('old_issue_create');

        if(isset($sessionData))
        {
            try{
                $sessionPhotos = $sessionData['fileUpload'];
                foreach($sessionPhotos as $photo)
                {
                    $photoImage = basename($photo);
                    Storage::disk('local')->delete('public/images/session_photo/'.$photoImage);
                }
            }
            catch(\Exception $e)
            {
                return  "image Deleting error " . $e->getMessage();
            }

        }
    }

    protected static function createIssue(array $data) :Issue
    {
        return Issue::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'status_id' => $data['status']['id'],
            'assign_id' => $data['assign']['id'],
            'workspace_id' => $data['currentWorkspace']['id'],
            'due_date' => $data['due_date'] ?? null,
            'creator_id' => auth()->id(),
        ]);

    }

    protected static function sendNotification($issue,$gov)
    {
        $data = [];
        $data['receiverEmail'] = $gov['assign']['email'];
        $data['receiverName'] = $gov['assign']['name'];
        $data['assigner'] = Auth::user()->name;
        $slug = $issue->slug;
        $data['issueUrl'] = route('workspace.issue.show',['workspace_name' => getCurrentWorkspaceName(),'slug' => $slug]);
        // Mail::to($receiver)->send(new IssueCreatedMail());

        // Notification::send('htetshine.htetmkk@gmail.com', new IssueCreated($issueUl, $receiverEmail));
        // Notification::send($receiver, (new IssueCreated($data['issueUrl'], $data['receiverEmail'])));
        SendIssueCreatedMail::dispatch($data);
        // dispatch(new SendIssueCreatedMail($data));
    }

}
