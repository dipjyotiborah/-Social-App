<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;
use App\Models\Exchange;

class ExchangeRequestNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $exchange;

    /**
     * Create a new notification instance.
     */
    public function __construct(Exchange $exchange)
    {
        $this->exchange = $exchange;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Exchange Request')
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('You have received an exchange request from ' . $this->exchange->offeredBy->name . '.')
            ->line('They want to exchange their post (ID: ' . $this->exchange->offered_post_id . ') with yours (ID: ' . $this->exchange->requested_post_id . ').')
            ->action('View Exchange Request', url('/exchanges'))
            ->line('Please respond to the request as soon as possible.');
    }

    /**
     * Get the array representation of the notification for database storage.
     */
    public function toArray($notifiable)
    {
        return [
            'message' => 'You have a new exchange request from ' . $this->exchange->offeredBy->name . '.',
            'exchange_id' => $this->exchange->id,
            'offered_post_id' => $this->exchange->offered_post_id,
            'requested_post_id' => $this->exchange->requested_post_id,
            'status' => 'pending',
        ];
    }
}
