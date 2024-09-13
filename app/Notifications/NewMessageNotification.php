<?php

namespace App\Notifications;

use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewMessageNotification extends Notification
{
    use Queueable;

    protected $message;
    protected $from_id;
    protected $conversation_id;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $message, int $from_id, int $conversation_id)
    {
        $this->message = $message;
        $this->from_id = $from_id;
        $this->conversation_id = $conversation_id;
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
    public function toMail(object $notifiable): MailMessage
    {
        $from = DB::table('users')
                    ->where('id', '=', $this->from_id)
                    ->first('name');

        return (new MailMessage)
                    ->subject('New message')
                    ->lines([
                        'You have a new message from ' . $from->name,
                        'Here\'s its content : ',
                        $this->message
                    ])
                    ->action('Consulter le message', route('inbox.show', $this->conversation_id));
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
}
