<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class BecomeTrainer extends Notification
{
    use Queueable;

    protected $data = [];

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data) {
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
    protected $regs = [
        1 => "Yes",
        2 => "No",
        3 => "Sometimes"
    ];

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('You have trainer request')
            ->line('Name: '.$this->data['name'])
            ->line('E-Mail: '.$this->data['email'])
            ->line('Experience: '.$this->data['experience'])
            ->line('Education: '.$this->data['education'])
            ->line('Achivements: '.$this->data['achievements'])
            ->line('Do you exercise regularly?: '. $this->regs[$this->data['regularly']])
            ->line('How confident are you with your rhowledge of exercise technique? ' . $this->data['skill'])
            
            ->action('Approve the request', url('/artivate_trainer/'.$this->data['remember_token']));
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
