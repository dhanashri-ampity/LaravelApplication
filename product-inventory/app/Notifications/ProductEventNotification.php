<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;



class ProductEventNotification extends Notification
{
    use Queueable;

    protected $eventMessage;

    public function __construct($eventMessage)
    {
        $this->eventMessage = $eventMessage;
    }

    public function via($notifiable)
    {
        // You can add logic here for user preferences
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Product Event Notification')
            ->line($this->eventMessage);
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => $this->eventMessage,
        ];
    }
}