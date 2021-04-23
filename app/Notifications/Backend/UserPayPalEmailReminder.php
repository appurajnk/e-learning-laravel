<?php

namespace App\Notifications\Backend;

use App\Models\Payout;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserPayPalEmailReminder extends Notification
{
    use Queueable;

    protected $payout;

    public function __construct(Payout $payout)
    {
        $this->payout = $payout;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

 
    public function toMail($notifiable)
    {
        return (new MailMessage)
                ->subject(config('app.name') . ': We are missing your PayPal Email')
                ->greeting('Hello '. $this->payout->user->full_name . ',')
                ->line('It\'s Payday! But we are unable to process your payment because we are missing your PayPal Email.')
                ->line('Please log into your account and update your payout settings.')
                ->action('Go to your settings', url('/profile/payout-settings'));
    }

}
