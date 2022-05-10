<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Appointment;

class ArchitectAppointmentExpirationReminder extends Notification
{
    use Queueable;

    public $appointment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Appointment $appointment)
    {
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
        return ['database', 'broadcast', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line("You still have not responded to the booking of your client {$this->appointment->client->name}.")
            ->line('The appointment will expire within 15 minutes.')
            ->line('Please click the button below to respond.')
            ->action('View Appointment', url(route("appointment.show", $this->appointment->id)))
            ->line('Thank you for using our application!');
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
            'user_id' => $this->appointment->client->id,
            'user_photo' => $this->appointment->client->profile_photo,
            'parent_id' => $this->appointment->id,
            'reference_id' => $this->appointment->id,
            'reference_link' => route("appointment.show", $this->appointment->id),
            'message' => "You still have not responded to the booking of your client {$this->appointment->client->name}. The appointment will expire within 15 minutes. Please click here to respond.",
        ];
    }
}
