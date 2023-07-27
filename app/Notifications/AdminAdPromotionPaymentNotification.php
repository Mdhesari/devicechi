<?php

namespace App\Notifications;

use App\Models\Ad;
use App\Models\MainUser;
use App\Models\Payment\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminAdPromotionPaymentNotification extends Notification
{
    use Queueable;

    public $ad;

    public $payment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Ad $ad, Payment $payment)
    {
        $this->ad = $ad;
        $this->payment = $payment;
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
            ->subject(__("admin::ads.payment.promotions"))
            ->line(__("admin::ads.payment.promotions", [
                'user' => $this->ad->user->phone,
                'promotions' => $this->ad->printablePromotions,
                'payment' =>  $this->payment->formattedRialAmount
            ]))
            ->action(__(' View '), route('admin.ads.show', $this->ad));
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
