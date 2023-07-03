<?php

namespace App\Jobs;

use App\Mail\IssueCreatedMail;
use App\Models\User;
use App\Notifications\IssueCreated;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class SendIssueCreatedMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $receiverEmail = $this->data['receiverEmail'];
            $issueUrl = $this->data['issueUrl'];
            $assigner = $this->data['assigner'];
            $receiverName = $this->data['receiverName'];

            Mail::to($receiverEmail)->queue(new IssueCreatedMail($receiverName, $issueUrl,$assigner));
            // if ($receiver) {
                // Notification::notify('htetshine.htetmkk@gmail.com', new IssueCreated($issueUrl, $receiverEmail));
            // }
        } catch (\Exception $exception) {
            Log::error('Failed to send issue notification: ' . $exception->getMessage() . $exception->getLine());
        }
    }
}
