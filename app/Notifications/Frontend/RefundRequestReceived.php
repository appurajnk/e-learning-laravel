<?php

namespace App\Notifications\Frontend;

use Illuminate\Bus\Queueable;
use App\Models\Refund;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RefundRequestReceived extends Notification implements ShouldQueue
{
    use Queueable;

    protected $refund;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Refund $refund)
    {
        $this->refund = $refund;
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
                ->subject('Refund request received')
                ->line('We have received your request for refund for "' . $this->refund->course->title . 
                        '". Your refund will be processed as soon as possible and you will be notified once it is processed.')
                ->line('Note that all refunds are paid to the same method that you used in the original purchase')
                ->action('Track your refund here', url('/home/my-courses/purchases'));
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
            
        ];
    }
}
