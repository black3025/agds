<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EnrollmentApproved extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $enrollment;
    public function __construct($enrollment)
    {
        $this->enrollment =$enrollment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('Enrollment Approved.')
                    ->line('Your enrollment to '. $this->enrollment->ClassSchedule->course->name. '- '.$this->enrollment->ClassSchedule->category->name .  ' has been approved.')
                    ->line('See you there!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            
                'data' =>'Your enrollment to '. $this->enrollment->ClassSchedule->course->name. '- '.$this->enrollment->ClassSchedule->category->name .  ' has been approved.'
        
        ];
    }
}
