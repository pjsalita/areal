<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use App\Notifications\RequestAppointment;
use App\Notifications\RespondAppointment;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Services\Google;

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
            ->where('start_date', '>=', Carbon::now())
            ->orderBy('created_at', 'desc')
            ->get();

        $upcomingAppointments = Appointment::where($isClient ? 'user_id' : 'architect_id', auth()->id())
            ->where('status', 'approved')
            ->where('start_date', '>=', Carbon::now())
            ->orderBy('start_date', 'asc')
            ->get();

        $ongoingAppointments = Appointment::where($isClient ? 'user_id' : 'architect_id', auth()->id())
            ->where('status', 'approved')
            ->where('start_date', '<=', Carbon::now())
            ->where('end_date', '>=', Carbon::now())
            ->orderBy('start_date', 'asc')
            ->get();

        $historyAppointments = Appointment::where($isClient ? 'user_id' : 'architect_id', auth()->id())
            ->where(function ($q) {
                $q->where('start_date', '<=', Carbon::now())
                    ->where('end_date', '<=', Carbon::now());
            })
            ->orWhere('status', 'declined')
            ->orderBy('end_date', 'desc')
            ->get();

        return view("appointments", compact('ongoingAppointments', 'historyAppointments', 'pendingAppointments', 'upcomingAppointments'));
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
        abort_if(!in_array(auth()->id(), [$appointment->architect_id, $appointment->user_id]), 404);

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
    public function update(Request $request, Appointment $appointment, Google $google)
    {
        if ($request->status === 'approved') {
            $service = $google->connectUsing($request->user()->google_token)->service('Calendar');
            $event = $google->connectUsing($request->user()->google_token)->service('Calendar_Event');

            $event->summary = 'AReal Appointment';
            $event->description = "An appointment between {$appointment->architect->name} & {$appointment->client->name}";
            $event->start = [ 'dateTime' => Carbon::parse($appointment->start_date) ];
            $event->end = [ 'dateTime' => Carbon::parse($appointment->end_date) ];
            $event->attendees = [
                [
                    'email' => $appointment->architect->email,
                    'name' => $appointment->architect->name,
                    'comment' => 'Architect',
                ],
                [
                    'email' => $appointment->client->email,
                    'name' => $appointment->client->name,
                    'comment' => 'Client',
                ]
            ];

            $event->conferenceData = [
                'createRequest' => [
                    'requestId' => time()
                ]
            ];

            $calendarEvent = $service->events->insert(collect($service->calendarList->listCalendarList())->first()->id, $event, ['conferenceDataVersion' => 1]);

            $appointment->link = $calendarEvent->hangoutLink;
        }

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
