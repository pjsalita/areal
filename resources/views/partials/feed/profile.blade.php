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

        @client
        @notself($user->id)
            <div class="mt-2">
                <a href="{{ route("chat") }}/{{ $user->id }}" id="openChat" class="card-link text-decoration-none">
                    <i class="fa fa-comments"></i>
                </a>
                <a href="#" class="card-link text-decoration-none" data-bs-toggle="modal" data-bs-target="#bookAppointment" onclick="$('#book-architect-id')[0].value = {{ $user->id }}">
                    <i class="fa fa-calendar"></i>
                </a>
            </div>
        @endnotself
        @endclient

        @guest
        @if ($user->account_type === "architect")
            <div class="mt-2">
                <a href="{{ route("home") }}/?r=login" id="openChat" class="card-link text-decoration-none">
                    <i class="fa fa-comments"></i>
                </a>
                <a href="{{ route("home") }}/?r=login" class="card-link text-decoration-none">
                    <i class="fa fa-calendar"></i>
                </a>
                <p>
                    Login or register to chat and book appointment.
                </p>
            </div>
        @endif
        @endguest
    </div>

    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <div class="h6 text-muted">On Going Projects</div>
            <div class="h5">5</div>
        </li>
        @self($user->id)
            <li class="list-group-item">
                <div class="h6 text-muted">Meeting Schedule</div>
                @client
                    @forelse ($user->clientAppointments()->approvedAppointments()->futureAppointments()->selectRaw('*, Date(start_date) as date')->get()->groupBy('date') as $date => $appointments)
                        <div class="mb-3">
                            <div class="h5">{{ Carbon\Carbon::parse($date)->format('F d, Y') }}</div>
                            @foreach ($appointments as $appointment)
                                <div class="h7">
                                    <a href="{{ route("appointment.show", $appointment->id) }}">{{ Carbon\Carbon::parse($appointment->start_date)->format('h:iA') }} - {{ Carbon\Carbon::parse($appointment->end_date)->format('h:iA') }}</a>
                                    with
                                    <a href="{{ route("profile.show", $appointment->architect->id) }}">{{ $appointment->architect->name }}</a>
                                </div>
                            @endforeach
                        </div>
                    @empty
                        <div class="h7">No upcoming appointments</div>
                    @endforelse
                @endclient

                @architect
                    @forelse ($user->architectAppointments()->approvedAppointments()->futureAppointments()->selectRaw('*, Date(start_date) as date')->get()->groupBy('date') as $date => $appointments)
                        <div class="mb-3">
                            <div class="h5">{{ Carbon\Carbon::parse($date)->format('F d, Y') }}</div>
                            @foreach ($appointments as $appointment)
                                <div class="h7">
                                    <a href="{{ route("appointment.show", $appointment->id) }}">{{ Carbon\Carbon::parse($appointment->start_date)->format('h:iA') }} - {{ Carbon\Carbon::parse($appointment->end_date)->format('h:iA') }}</a>
                                    with
                                    <a href="{{ route("profile.show", $appointment->client->id) }}">{{ $appointment->client->name }}</a>
                                </div>
                            @endforeach
                        </div>
                    @empty
                        <div class="h7">No upcoming appointments</div>
                    @endforelse
                @endarchitect
            </li>
        @endself
    </ul>
</div>
