@section('title', "Appointment #" . Str::ucfirst($appointment->id))

<x-app-layout>
    <div class="my-3 container-fluid">
        <div class="row">
            <div class="col-md-3">
                @include('partials.feed.profile', [ 'user' => auth()->user() ])
            </div>
            <div class="col-md-9">
                @architect
                    @if (!auth()->user()->google_token)
                        <a href="{{ route("google.store") }}" class="mb-2 btn btn-primary text-decoration-none"><i class="fa fa-lock"></i> Authenticate</a>
                    @endif
                @endarchitect

                @include('partials.feed.appointment', [ 'appointment' => $appointment ])
            </div>
        </div>
    </div>
</x-app-layout>
