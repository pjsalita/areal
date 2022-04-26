<div class="mb-2 card">
    <div class="card-body">
        <img src="{{ $user->profile_photo }}" alt="" class="img-thumbnail w-100">
        <div class="mt-2 mb-0 h5">
            <a href="{{ route('profile.show', $user->id) }}" class="text-capitalize">{{ $user->name }}</a>
            @if($user->hasVerifiedEmail())
                @if($user->account_type === "architect")
                    @if($user->prc_verified)
                        <i class="ms-1 fa fa-check-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Email and PRC verified."></i>
                    @endif
                @else
                    <i class="ms-1 fa fa-check-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Email verified."></i>
                @endif
            @endif
            @self($user->id)
                @unverified
                    <form action="{{ route('profile.resend') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="p-0 btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Resend verification link." style="outline: none; color: #296e6b; font-size: 1.25rem; vertical-align: unset; line-height: 1.2;">
                            <i class="ms-1 fa fa-envelope"></i>
                        </button>
                    </form>
                @endunverified

                <a href="{{ route('profile.edit') }}" class="">
                    <i class="ms-1 fa fa-pencil"></i>
                </a>
            @endself
        </div>
        <div class="text-capitalize h6">{{ $user->position }}</div>

        @if($user->phone_number)
            <div class="h7 text-muted">Contact Number : <a href="tel:{{ $user->phone_number }}">{{ $user->phone_number }}</a></div>
        @endif

        <div class="h7 text-muted">Email : <a href="mailto:{{ $user->email }}">{{ $user->email }}</a></div>

        @if($user->address)
            <div class="h7 text-muted">Address : {{ $user->address }}</div>
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
        @foreach ($user->achievements as $achievement)
            <li class="list-group-item">
                <div class="h6 text-muted text-capitalize">{{ $achievement->name }}</div>
                <div class="h5">{{ $achievement->value }}</div>
            </li>
        @endforeach

        @self($user->id)
            @client
                <li class="list-group-item">
                    <div class="h6 text-muted">Meeting Schedule</div>
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
                </li>
            @endclient

            @architect
                <li class="list-group-item">
                    <div class="h6 text-muted">Meeting Schedule</div>
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
                </li>
            @endarchitect
        @endself
    </ul>
</div>
