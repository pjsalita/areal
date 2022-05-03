@section('title', "Appointment")

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
                    @else
                        <a href="{{ route("google.store") }}" class="mb-2 btn btn-primary text-decoration-none" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Reauthenticate if you have problem approving your appointments."><i class="fa fa-lock"></i> Reauthenticate</a>
                    @endif
                @endarchitect

                @include('partials.feed.appointment', [ 'appointment' => $appointment ])
            </div>
        </div>
    </div>
</x-app-layout>
