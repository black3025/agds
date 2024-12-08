<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RescheduledEventNotification extends Notification
{
  use Queueable;

  /**
   * Create a new notification instance.
   */
  public function __construct($old, $new)
  {
    $this->oldEvent = $old;
    $this->newEvent = $new;
  }

  /**
   * Get the notification's delivery channels.
   *
   * @return array<int, string>
   */
  public function via(object $notifiable): array
  {
    return ['mail', 'database'];
  }

  /**
   * Get the mail representation of the notification.
   */
  public function toMail(object $notifiable): MailMessage
  {
    return (new MailMessage())
      ->line(
        'There was an adjustment for your ' . date('F d, Y H:i:s a', strtotime($this->oldEvent->start_time)) . '. '
      )
      ->line('This is move to: ' . date('F d, Y H:i:s a', strtotime($this->oldEvent->start_time)))
      ->action('See Schedule', url('/enrolled'))
      ->line('Please be guided accordingly');
  }

  /**
   * Get the array representation of the notification.
   *
   * @return array<string, mixed>
   */
  public function toArray(object $notifiable): array
  {
    return [
      'data' =>
        'There was an adjustment for your ' .
        date('F d, Y H:i:s a', strtotime($this->oldEvent->start_time)) .
        ' ' .
        'This is move to: ' .
        date('F d, Y H:i:s a', strtotime($this->oldEvent->start_time)) .
        '. Please be guided accordingly.',
    ];
  }
}
