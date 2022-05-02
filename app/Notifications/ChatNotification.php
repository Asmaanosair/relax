<?php

namespace App\Notifications;

use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ChatNotification extends Notification
{
    use Queueable;

    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $request;
    public function __construct( Request $request)
    {
        $this->Request=$request;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toDatabase()
    {
        return [
            'user_id'=>$this->Request->user_id,
            'doctor_id'=>1,
            'message'=>$this->Request->message,

        ];
    }
}
