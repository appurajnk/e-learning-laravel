<?php

namespace App\Notifications\Backend;

use App\Models\Payout;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PayoutProcessed extends Notification
{
    use Queueable;

    protected $payout;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Payout $payout)
    {
        $this->payout = $payout;
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
            ->subject(config('app.name') . ': Your payout has been processed (i.e. we sent you money!)')
            ->greeting('Hello '. $this->payout->user->full_name . ',')
            ->line('It\'s Payday! We just processed your payout for ' . format_currency($this->payout->net_earnings) . ' via ' . $this->payout->payment_address . '"')
            ->line('Your payout was sent to ' . $this->payout->payment_address)
            ->line('Happy Spending! ' . $this->payout->payment_address);
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
