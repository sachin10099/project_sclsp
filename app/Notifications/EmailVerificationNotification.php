<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Http\Controllers\Concern\GlobalTrait;
use Illuminate\Notifications\Messages\MailMessage;

class EmailVerificationNotification extends Notification
{
    use Queueable, GlobalTrait;

    protected $url;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($url)
    {
        $this->url = $url;
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
        $data['link']          = $this->url;
        $data['company_email'] = $this->siteConfig('COMPANY_EMAIL');
        return (new MailMessage)
            ->subject('Email Configuration')
            ->markdown('emails.email_verify', compact('data'));
    }
}
