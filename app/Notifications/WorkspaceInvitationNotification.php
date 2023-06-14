<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class WorkspaceInvitationNotification extends Notification
{
    use Queueable;

    private string $workspaceUrl;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $workspaceUrl,protected string $wsn,protected string $receiverEmail)
    {
        $this->workspaceUrl = $workspaceUrl;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->from(Auth::user()->email)
                    ->replyTo($this->receiverEmail)
                    ->subject('Invitation to Workspace')
                    ->line('You have been invited to ' .  $this->wsn . ' workspace')
                    ->action('Accpet Invitation', $this->workspaceUrl)
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
