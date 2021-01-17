<?php

namespace Modules\User\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Log;

class CodeVerificatiNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Notification channels
     *
     * @var mixed
     */
    protected $channels;

    /**
     * Verification code
     *
     * @var mixed
     */
    protected $code;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->channels = $data['channels'] ?? [env('GHAESDAK_NOTIF', '')];
        $this->code = $data['code'] ?? null;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
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
            ->line('{MFS} Your verification code is ' . $this->getCode($notifiable))
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

        $message = '{MFS} Your verification code is ' . $this->getCode($notifiable);

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
        Log::info('Mobileforsale.ir : Your verification code is ' . $this->getCode($notifiable) . ', number requested : ' . ($notifiable->routeNotificationFor('sms', $this) ?? $notifiable->phone));

        return [
            'code' => $this->getCode($notifiable),
        ];
    }

    /**
     * Get verification code
     *
     * @param  mixed $notifiable
     * @return void
     */
    public function getCode($notifiable)
    {

        return $this->code ?? $notifiable->getVerificationCode();
    }
}
