<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class JobApplyNotification extends Notification
{
    use Queueable;
    protected $data;
    protected $msg;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data, $msg)
    {
        $this->data = $data;
        $this->msg  = $msg;
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
    public function toArray($notifiable)
    {
        $msg = \Auth::user()->name.' has just apply for a '.$this->msg;
        return [
            'message' => $msg,
            'data'    => $this->data,
            'type'    => 'apply_job'
        ];
    }
}
