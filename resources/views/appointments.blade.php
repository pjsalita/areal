@section('title', "Appointments")

<x-app-layout>
    <div class="my-3 container-fluid">
        <div class="row">
            <div class="col-md-3">
                @include('partials.feed.profile', [ 'user' => auth()->user() ])
            </div>
            <div class="col-md-3">
                <div class="card mb-1">
                    <div class="card-header border-bottom-0">Pending</div>
                </div>
                @forelse ($pendingAppointments as $appointment)
                    @include('partials.feed.appointment', [ 'appointment' => $appointment ])
                @empty
                    <div class="text-center">
                        <p>No pending appointments.</p>
                    </div>
                @endforelse
            </div>

            <div class="col-md-3">
                <div class="card mb-1">
                    <div class="card-header border-bottom-0 bg-success text-white">Approved</div>
                </div>
                @forelse ($approvedAppointments as $appointment)
                    @include('partials.feed.appointment', [ 'appointment' => $appointment ])
                @empty
                    <div class="text-center">
                        <p>No upcoming appointments.</p>
                    </div>
                @endforelse
            </div>

            <div class="col-md-3">
                <div class="card mb-1">
                    <div class="card-header border-bottom-0 bg-danger text-white">Declined</div>
                </div>
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
</x-app-layout>
