<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendConfirmationNotification extends Notification
{
    use Queueable;

    protected $data;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
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
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {

        $msg = 'Order '.$this->data->order_id. ' is successfully confirmed by '. $notifiable->name;
        return [
            'title'   => $this->data->job_title,
            'message' => $msg,
            'data'    => $this->data,
            'job_id'  => $this->data->id,
            'type'    => 'user_confirmation'
        ];
    }
}
