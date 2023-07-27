<?php

namespace App\Notifications;

use App\Models\Ad;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Log;

abstract class BaseAdReview extends Notification
{
    use Queueable;

    /**
     * channels
     *
     * @var array
     */
    protected $channels;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($channels = ['ghasedak'])
    {
        $this->channels = $channels;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['ghasedak'];
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
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
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
        return [
            'template' => $this->getTemplate(),
            'placeholders' => $this->getPlaceHolders($notifiable),
        ];
    }

    public abstract function getTemplate();

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

    public function getPlaceHolders($notifiable)
    {
        return [
            $notifiable->phoneModel->brand->printableName
        ];
    }
}
