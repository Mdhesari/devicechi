<?php

namespace Modules\User\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Log;

class ContactCodeVerificationNotification extends Notification
{
    use Queueable;

    /**
     * Notification channels
     *
     * @var mixed
     */
    protected $channels;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->channels = isset($data['channels']) ? $data['channels'] : null;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        $this->channels = $this->channels ?? [];

        return array_merge($this->channels, ['database']);
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', 'https://laravel.com')
            ->line('Thank you for using our application!');
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return string
     */
    public function toGhasedak($notifiable)
    {

        $message = '{MFS} Your verification code is ' . $notifiable->getVerificationCode();

        return $message;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        Log::info("Code verification is {$notifiable->getVerificationCode()}, value is : {$notifiable->value}");

        return [
            //
        ];
    }
}
