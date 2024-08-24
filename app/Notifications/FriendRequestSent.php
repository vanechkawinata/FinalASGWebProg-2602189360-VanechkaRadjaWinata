<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FriendRequestSent extends Notification
{
    use Queueable;

    protected $sender_id;

    public function __construct($sender_id)
    {
        $this->sender_id = $sender_id;
    }

    public function via($notifiable)
    {
        return ['database']; // Atau tambahkan 'mail' jika ingin mengirim email
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => "User {$this->sender_id} has sent you a friend request.",
            'action_url' => url('/notifications'), // Atur URL yang sesuai
        ];
    }
}
