@section('title', "Appointments")

<x-app-layout>
    <div class="my-3 container-fluid">
        <div class="row">
            <div class="col-md-3">
                @include('partials.feed.profile', [ 'user' => auth()->user() ])
            </div>
            <div class="col-md-9">
                @include('partials.feed.alerts')

                @architect
                    @if (!auth()->user()->google_token)
                        <a href="{{ route("google.store") }}" class="mb-2 btn btn-primary text-decoration-none"><i class="fa fa-lock"></i> Authenticate</a>
                    @endif
                @endarchitect

                <ul class="nav nav-pills nav-fill" id="appointments">
                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#pendingAppointments" type="button" role="tab">Pending</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#upcomingAppointments" type="button" role="tab">Upcoming</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#ongoingAppointments" type="button" role="tab">Ongoing</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#historyAppointments" type="button" role="tab">History</button>
                    </li>
                </ul>
                <div class="pt-4 tab-content" id="appointmentsContent">
                    <div class="tab-pane fade show active" id="pendingAppointments">
                        <div class="row">
                            @forelse ($pendingAppointments as $appointment)
                                <div class="mb-2 col-4">
                                    @include('partials.feed.appointment', [ 'appointment' => $appointment, 'classNames' => 'h-100' ])
                                </div>
                            @empty
                                <div class="text-center">
                                    <p>No pending appointments.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="tab-pane fade" id="upcomingAppointments">
                        <div class="row">
                            @forelse ($upcomingAppointments as $appointment)
                                <div class="mb-2 col-4">
                                    @include('partials.feed.appointment', [ 'appointment' => $appointment, 'classNames' => 'h-100' ])
                                </div>
                            @empty
                                <div class="text-center">
                                    <p>No upcoming appointments.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="tab-pane fade" id="ongoingAppointments">
                        <div class="row">
                            @forelse ($ongoingAppointments as $appointment)
                                <div class="mb-2 col-4">
                                    @include('partials.feed.appointment', [ 'appointment' => $appointment, 'classNames' => 'h-100' ])
                                </div>
                            @empty
                                <div class="text-center">
                                    <p>No ongoing appointments.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="tab-pane fade" id="historyAppointments">
                        <div class="row">
                            @forelse ($historyAppointments as $appointment)
                                <div class="mb-2 col-4">
                                    @include('partials.feed.appointment', [ 'appointment' => $appointment, 'classNames' => 'h-100' ])
                                </div>
                            @empty
                                <div class="text-center">
                                    <p>No appointments found.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
