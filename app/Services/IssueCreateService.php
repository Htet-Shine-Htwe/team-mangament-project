<?php

namespace App\Services;

use App\Models\Issue;
use App\Models\IssuePhoto;
use App\Storage\S3FileStorage;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use Illuminate\Support\Facades\Storage;

class IssueCreateService
{

    public function __construct(protected S3FileStorage $storage)
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
        $issue = Issue::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'status_id' => $data['status']['id'],
            'assign_id' => $data['assign']['id'],
            'workspace_id' => $data['currentWorkspace']['id'],
            'due_date' => $data['due_date'] ?? null,
            'creator_id' => auth()->id(),
        ]);

        self::saveImages($files,$issue);

        self::deleteSessionImage();

        session()->forget('old_issue_create');


        return redirect()->route('workspace.issue.index',['workspace_name' => getCurrentWorkspaceName()]);
        // return $issue;
    }

    protected static function saveImages($files,$issue)
    {
        $uploadedFiles = [];
        if($files){
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
                $sessionPhotos = ['fileUpload'];
                foreach($sessionPhotos as $photo)
                {
                    //remove photo
                    Storage::delete('app/public/images/session_photo/'.$photo);
                }
            }
            catch(\Exception $e)
            {
                return  "image Deleting error " . $e->getMessage();
            }

        }
    }

}
