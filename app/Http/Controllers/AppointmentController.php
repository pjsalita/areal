<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use App\Notifications\RequestAppointment;
use App\Notifications\RespondAppointment;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Spatie\GoogleCalendar\Event;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $isClient = auth()->user()->account_type === "client";
        $pendingAppointments = Appointment::where($isClient ? 'user_id' : 'architect_id', auth()->id())
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        $approvedAppointments = Appointment::where($isClient ? 'user_id' : 'architect_id', auth()->id())
            ->where('status', 'approved')
            ->orderBy('start_date', 'asc')
            ->get();

        $declinedAppointments = Appointment::where($isClient ? 'user_id' : 'architect_id', auth()->id())
            ->where('status', 'declined')
            ->orderBy('created_at', 'desc')
            ->get();

        return view("appointments", compact('pendingAppointments', 'approvedAppointments', 'declinedAppointments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dates = explode(" - ", $request->dates);

        $appointment = Appointment::create([
            'user_id' => auth()->id(),
            'architect_id' => $request->architect_id,
            'message' => $request->message,
            'start_date' => Carbon::parse($dates[0]),
            'end_date' => Carbon::parse($dates[1]),
        ]);

        $architect = User::find($request->architect_id);
        $architect->notify(new RequestAppointment($request->user(), $appointment));

        return response()->json([ 'success' => true, 'appointment_id' => $appointment->id ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        return view("appointment", compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        // $event = new Event;
        // $event->name = 'AReal Appointment';
        // $event->description = "An appointment between {$appointment->architect->name} & {$appointment->client->name}";
        // $event->startDateTime = Carbon::parse($appointment->start_date);
        // $event->endDateTime = Carbon::parse($appointment->end_date);
        // $event->addAttendee([
        //     'email' => $appointment->architect->email,
        //     'name' => $appointment->architect->name,
        //     'comment' => 'Architect',
        // ]);
        // $event->addAttendee([
        //     'email' => $appointment->client->email,
        //     'name' => $appointment->client->name,
        //     'comment' => 'Client',
        // ]);

        // $event->save();

        $appointment->status = $request->status;
        $appointment->save();
        $appointment->client->notify(new RespondAppointment($request->user(), $appointment));

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
