<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Event;

class EventReminderNotification extends Notification implements ShouldQueue // telling laravel that it should done through the background not during the request
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public Event $event,
    )
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage  // to construct emails
    {
        return (new MailMessage)
                    ->line('Reminder: You have an upcoming event!')
                    ->action('View Event', route('events.show',$this->event->id))
                    ->line(
                        "The event {$this->event->name} starts at {$this->event->start_time}"
                    );
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array // store it in a db
    {
        return [
            'event_id' => $this->event->id,
            'event_name' => $this->event->name,
            'start_time' => $this->event->start_time
        ];
    }
}
