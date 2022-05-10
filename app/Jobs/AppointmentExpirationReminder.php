<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Appointment;
use App\Notifications\ClientAppointmentExpirationReminder as ClientNotification;
use App\Notifications\ArchitectAppointmentExpirationReminder as ArchitectNotification;
use Carbon\Carbon;

class AppointmentExpirationReminder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $appointment;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->appointment->status === 'pending' && Carbon::parse($this->appointment->start_date)->isPast()) {
            $this->appointment->client->notify(new ClientNotification($this->appointment));
            $this->appointment->architect->notify(new ArchitectNotification($this->appointment));
        }
    }
}
