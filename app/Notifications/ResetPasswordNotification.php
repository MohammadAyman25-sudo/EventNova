<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class ResetPasswordNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $token;
    public $user;
    public $upcomingEvents;

    /**
     * Create a new notification instance.
     */
    public function __construct($token, $user=null)
    {
        $this->token = $token;
        $this->user = $user;

        if ($user && method_exists($user, 'registrations')) {
            $this->upcomingEvents = $user->registrations()
                                    ->with('event')
                                    ->whereHas('event', function ($query) {
                                        $query->where('starts_date', '>', now);
                                    })
                                    ->orderBy('events.start_date')
                                    ->limit(3)
                                    ->get()
                                    ->pluck('event');
        } else {
            $this->upcomingEvents = collect();
        }
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
        $resetUrl = $this->resetUrl($notifiable);

        return (new MailMessage)
            ->subject(__('Reset Your EventNova Password'))
            ->view('emails.password-reset-link', [
                'user' => $notifiable,
                'resetUrl' => $resetUrl,
                'upcomingEvents' => $this->upcomingEvents,
            ]);
    }

    protected function resetUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'password.reset',
            now()->addMinutes(config('auth.passwords.'.config('auth.defaults.passwords').'.expire', 60)),
            [
                'token' => $this->token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ]
        );
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'token' => $this->token,
            'email' => $notifiable->email,
        ];
    }
}
