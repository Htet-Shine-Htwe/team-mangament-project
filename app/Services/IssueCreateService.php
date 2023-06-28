<?php

namespace App\Services;

use App\Models\Issue;
use App\Models\IssuePhoto;
use App\Storage\S3FileStorage;

class IssueCreateService
{

    public function __construct(protected S3FileStorage $storage)
    {

    }

    public static function create($data, $files = null)
    {
        $issue = Issue::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'status_id' => $data['status']['id'],
            'assign_id' => $data['assign']['id'],
            'workspace_id' => $data['currentWorkspace']['id'],
            'creator_id' => auth()->id(),
        ]);

        self::saveImages($files,$issue);

        session()->forget('old_issue_create');

        return 'suceess';
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
                return $e->getMessage();
           }
    }

    }}
