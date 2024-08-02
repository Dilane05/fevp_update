<?php

namespace App\Notifications;

use App\Models\Consultation;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use NotificationChannels\WhatsApp\WhatsAppChannel;
use NotificationChannels\WhatsApp\WhatsAppTemplate;
use NotificationChannels\WhatsApp\WhatsAppTextMessage;

class ConsultationBooked extends Notification
{
    use Queueable;

    public $consultation;
    /**
     * Create a new notification instance.
     */
    public function __construct(Consultation $consultation)
    {
        $this->consultation = $consultation;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [WhatsAppChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }

    public function toWhatsapp($notifiable)
    {
        return WhatsAppTextMessage::create()
        ->message('Hello, this is a test message'. $this->consultation->token)
        ->to($notifiable->phone_number);
    }
}
