<div class="mb-2 card">
    @if(request()->routeIs('profile.edit'))
        <div class="card-header">
            <p class="m-0">Update profile picture</p>
        </div>
    @endif
    <div class="card-body">
        @if(request()->routeIs('profile.edit'))
            <form action="{{ route('profile.avatar') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <label class="profile-picture">
                    <input accept=".png,.jpg,.jpeg,.gif,.bmp" name="avatar" type="file" style="display: none" onchange="updatePreview(event)"/>
                    <img src="{{ $user->profile_photo }}" alt="" class="img-thumbnail w-100" id="profile-picture-preview">
                    <div class="overlay">
                        <i class="fa fa-camera"></i>
                    </div>
                </label>
                <button class="btn btn-primary mt-2">Save</button>
            </form>
        @else
            <img src="{{ $user->profile_photo }}" alt="" class="img-thumbnail w-100">
        @endif

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

                @if(!request()->routeIs('profile.edit'))
                <a href="{{ route('profile.edit') }}" class="">
                    <i class="ms-1 fa fa-pencil"></i>
                </a>
                @endif
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

        @auth
        @notself($user->id)
            <div class="mt-2">
                @if ($user->account_type === 'client')
                @architect
                    <a href="{{ route("chat") }}/{{ $user->id }}" id="openChat" class="card-link text-decoration-none">
                        <i class="fa fa-comments"></i>
                    </a>
                @endarchitect
                @endif

                @if ($user->account_type === 'architect')
                    <a href="{{ route("chat") }}/{{ $user->id }}" id="openChat" class="card-link text-decoration-none">
                        <i class="fa fa-comments"></i>
                    </a>
                    @client
                        <a href="#" class="card-link text-decoration-none" data-bs-toggle="modal" data-bs-target="#bookAppointment" onclick="$('#book-architect-id')[0].value = {{ $user->id }}">
                            <i class="fa fa-calendar"></i>
                        </a>
                    @endclient
                @endif
            </div>
        @endnotself
        @endauth

        @guest
            <div class="mt-2">
                <a href="{{ route("home") }}/?r=login" id="openChat" class="card-link text-decoration-none">
                    <i class="fa fa-comments"></i>
                </a>
                @if ($user->account_type === "architect")
                    <a href="{{ route("home") }}/?r=login" class="card-link text-decoration-none">
                        <i class="fa fa-calendar"></i>
                    </a>
                    <p class="m-0">
                        Login or register to chat and book appointment.
                    </p>
                @else
                    <p class="m-0">
                        Login or register to chat client.
                    </p>
                @endif
            </div>
        @endguest
    </div>

    <ul class="list-group list-group-flush">
        @if ($user->bio)
            <li class="list-group-item">
                <div class="h6 text-muted text-capitalize">Bio</div>
                <div class="h5">{{ $user->bio }}</div>
            </li>
        @endif

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

@push('styles')
    <style>
        .profile-picture {
            position: relative;
            display: block;
            cursor: pointer;
        }
        .overlay {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            height: 100%;
            width: 100%;
            opacity: 0;
            transition: .5s ease;
            background-color: rgb(247 247 247 / .5);
            z-index: -1;
        }
        .profile-picture:hover .overlay {
            opacity: 1;
            z-index: 1;
        }

        .profile-picture .overlay i {
            position: absolute;
            font-size: 20px;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            text-align: center;
        }
    </style>
@endpush

@push('scripts')
    <script>
        function updatePreview(event) {
            const preview = document.getElementById('profile-picture-preview');
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.readAsDataURL(file);
            reader.addEventListener("load", (e) => {
                preview.src = e.target.result
            });
        }
    </script>
@endpush
