<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use App\Models\User;
use App\Models\Appointment;

class RespondAppointment extends Notification
{
    use Queueable;

    protected $user;
    protected $appointment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, Appointment $appointment)
    {
        $this->user = $user;
        $this->appointment = $appointment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
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
            'user_id' => $this->user->id,
            'user_photo' => $this->user->profile_photo,
            'parent_id' => $this->appointment->id,
            'reference_id' => $this->appointment->id,
            'reference_link' => route("appointment.show", $this->appointment->id),
            'message' => "{$this->user->first_name} {$this->appointment->status} your appointment.",
        ];
    }
}
