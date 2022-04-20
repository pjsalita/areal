<div class="mb-2 card">
    <div class="card-body">
        <img src="{{ $user->profile_photo }}" alt="..."
            class="img-thumbnail w-100">
        <div class="mt-2 mb-0 h5">
            <a href="{{ route('profile.show', $user->id) }}">{{ $user->name }}</a>
            @if($user->hasVerifiedEmail())
                <i class="ms-1 fa fa-check-circle"></i>
            @endif
        </div>
        <div class="text-capitalize h6">{{ $user->position }}</div>

        @if($user->phone_number)
            <div class="h7 text-muted">Contact Number : <a href="tel:{{ $user->phone_number }}">{{ $user->phone_number }}</a></div>
        @endif

        <div class="h7 text-muted">Email : <a href="mailto:{{ $user->email }}">{{ $user->email }}</a></div>

        @if($user->address)
            <div class="h7 text-muted">Address : Blk 10 Lot 8 Sapang matakla, Planet Namec</div>
        @endif
    </div>

    @self($user->id)
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <div class="h6 text-muted">Meeting Schedule</div>
                @client
                    @forelse ($user->clientAppointments()->approvedAppointments()->get() as $appointment)
                        <div class="mb-3">
                            <div class="h5"><a href="{{ route("appointment.show", $appointment->id) }}">{{ Carbon\Carbon::parse($appointment->end_date)->format('F d, Y') }}</a></div>
                            <div class="h7">{{ Carbon\Carbon::parse($appointment->start_date)->format('h:iA') }} - {{ Carbon\Carbon::parse($appointment->end_date)->format('h:iA') }} with <a href="{{ route("profile.show", $appointment->architect->id) }}">{{ $appointment->architect->name }}</a></div>
                        </div>
                    @empty
                        <div class="h7">No upcoming appointments</div>
                    @endforelse
                @endclient

                @architect
                    @forelse ($user->architectAppointments()->approvedAppointments()->get() as $appointment)
                        <div class="mb-3">
                            <div class="h5"><a href="{{ route("appointment.show", $appointment->id) }}">{{ Carbon\Carbon::parse($appointment->end_date)->format('F d, Y') }}</a></div>
                            <div class="h7">{{ Carbon\Carbon::parse($appointment->start_date)->format('h:iA') }} - {{ Carbon\Carbon::parse($appointment->end_date)->format('h:iA') }} with <a href="{{ route("profile.show", $appointment->client->id) }}">{{ $appointment->client->name }}</a></div>
                        </div>
                    @empty
                        <div class="h7">No upcoming appointments</div>
                    @endforelse
                @endarchitect
            </li>
        </ul>
    @endself

</div>
