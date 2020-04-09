<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Http\Controllers\Concern\GlobalTrait;
use Illuminate\Notifications\Messages\MailMessage;

class QueryResponseNotification extends Notification
{
    use Queueable, GlobalTrait;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $data['name']          = $notifiable->name;
        $data['site']          = $this->siteConfig('SITE');
        $data['question']      = $notifiable->query;
        $data['answer']        = $notifiable->response;
        $data['company_email'] = $this->siteConfig('COMPANY_EMAIL');
        return (new MailMessage)
                   ->subject('Query Response')
            ->markdown('emails.query_response', compact('data'));
    }
}
