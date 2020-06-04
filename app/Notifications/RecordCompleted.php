<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RecordCompleted extends Notification
{
    use Queueable;

    public $record;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($record)
    {
        $this->record = $record;
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

        $record = $this->record;

        $api_token = $record->business->api_token;

        $url = 'http://sk.test/api/record-print?api_token=' . $record->business->api_token . '&tracking=' . $record->tracking;

        return (new MailMessage)
                    ->line('Report for ' . $record->last_name . ", " . $record->first_name . " is complete.")
                    ->line('Use the download button to download the report.')
                    ->action('Download', url($url))
                    ->line('Thank you for using !!!!!!!');
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
