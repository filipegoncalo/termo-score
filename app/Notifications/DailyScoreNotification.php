<?php

namespace App\Notifications;

use App\Models\DailyScore;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DailyScoreNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public DailyScore $dailyScore)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(User $notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting($notifiable->name)
            ->line('Your daily entry was analyzed.')
            ->line("You got {$this->dailyScore->points} new points.")
            ->action('Check Your Points', url()->route('dashboard'))
            ->line('Congratulations 🎉🎉🎉 Jetete!!!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(User $notifiable): array
    {
        return [
            'message' => "Your daily entry was analyzed. You got {$this->dailyScore->points} new points. 🎉",
            'status'  => 'success',
        ];
    }
}
