@section('title', "Appointments")

<x-app-layout>
    <div class="my-3 container-fluid">
        <div class="row">
            <div class="col-md-3">
                @include('partials.feed.profile', [ 'user' => auth()->user() ])
            </div>
            <div class="col-md-9">
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
                <div class="tab-content pt-4" id="appointmentsContent">
                    <div class="tab-pane fade show active" id="pendingAppointments">
                        <div class="row">
                            @forelse ($pendingAppointments as $appointment)
                                <div class="col-4 mb-2">
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
                                <div class="col-4 mb-2">
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
                                <div class="col-4 mb-2">
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
                                <div class="col-4 mb-2">
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

                {{-- <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-1">
                            <div class="card-header border-bottom-0 bg-success text-white">Approved</div>
                        </div>
                        <div style="overflow: auto; max-height: 500px">
                            @forelse ($approvedAppointments as $appointment)
                                @include('partials.feed.appointment', [ 'appointment' => $appointment ])
                            @empty
                                <div class="text-center">
                                    <p>No upcoming appointments.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card mb-1">
                            <div class="card-header border-bottom-0 bg-danger text-white">Declined</div>
                        </div>
                        <div style="overflow: auto; max-height: 500px">
                            @forelse ($declinedAppointments as $appointment)
                                @include('partials.feed.appointment', [ 'appointment' => $appointment ])
                            @empty
                                <div class="text-center">
                                    <p>No declined appointments.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-6">
                        <div class="card mb-1">
                            <div class="card-header border-bottom-0">Pending</div>
                        </div>
                        <div style="overflow: auto; max-height: 500px">
                            @forelse ($pendingAppointments as $appointment)
                                @include('partials.feed.appointment', [ 'appointment' => $appointment ])
                            @empty
                                <div class="text-center">
                                    <p>No pending appointments.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card mb-1">
                            <div class="card-header border-bottom-0">History</div>
                        </div>
                        <div style="overflow: auto; max-height: 500px">
                            @forelse ($pastAppointments as $appointment)
                                @include('partials.feed.appointment', [ 'appointment' => $appointment ])
                            @empty
                                <div class="text-center">
                                    <p>No pending appointments.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</x-app-layout>
