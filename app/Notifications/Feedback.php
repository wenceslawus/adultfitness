<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Feedback extends Notification
{
    use Queueable;

    protected $data = [];
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
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
        $mail = (new MailMessage)
            ->line('You have new feedback from AdultFitness');

        if($this->data['name']) {
            $mail->line('Message from ' . $this->data['name']);
        }
        if($this->data['email']) {
            $mail->line('Email: ' . $this->data['email']);
        }

        $mail->line('Message: ' . $this->data['description'])
            ->line('Rate: ' . $this->data['rate'])
            ->line('Category: ' . $this->data['cat']);
        return $mail;
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
