<?php

namespace App\Notifications\panel;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class PasswordSent extends Notification
{
    use Queueable;

    protected $data;
    protected $password;
    /**
     * Create a new notification instance.
     */
    public function __construct($data, $Password)
    {
        $this->data = $data;
        $this->password = $Password;
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
        return (new MailMessage)
            ->from(''.config('mail.from.address'), Lang::get(config('app.NAME_SENDER')))
            ->subject($this->data['fullname'].','.Lang::get('New Password'))
            ->greeting(Lang::get('Hi :name', ['name' => $this->data['fullname']]))
            ->line(Lang::get('Your account password has been successfully created in :account.', ['account' => Lang::get(config('app.NAME_SENDER'))]))
            ->line(Lang::get('Your password is : :password', ['password' => $this->password]))
            ->line(Lang::get('Thanks for using :app !', ['app' => Lang::get(config('app.NAME_SENDER'))]));
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
