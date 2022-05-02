<div class="card @isset($classNames) {{ $classNames }} @endisset">
    <div class="card-header">
        <h5 class="m-0"><a href="{{ route("appointment.show", $appointment->id) }}">{{ Carbon\Carbon::parse($appointment->end_date)->format('F d, Y') }}</a></h5>
        <p class="d-inline text-muted h7" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $appointment->created_at->toDateTimeString() }}"> <i class="fa fa-clock-o"></i> {{ $appointment->created_at->diffForHumans() }}</p>
    </div>
    <div class="card-body">
        <div class="h7">
            Time: {{ Carbon\Carbon::parse($appointment->start_date)->format('h:iA') }} - {{ Carbon\Carbon::parse($appointment->end_date)->format('h:iA') }}
        </div>

        @client
            <div class="h7">
                Architect: <a href="{{ route("profile.show", $appointment->architect->id) }}">{{ $appointment->architect->name }}</a>
                <a href="{{ route("chat") }}/{{ $appointment->architect->id }}" id="openChat" class="card-link text-decoration-none">
                    <i class="fa fa-comments"></i>
                </a>
            </div>
        @endclient

        @architect
            <div class="h7">
                Client: <a href="{{ route("profile.show", $appointment->client->id) }}">{{ $appointment->client->name }}</a>
                <a href="{{ route("chat") }}/{{ $appointment->client->id }}" id="openChat" class="card-link text-decoration-none">
                    <i class="fa fa-comments"></i>
                </a>
            </div>
        @endarchitect

        <div class="h7">
            Status:
            @if ($appointment->status === 'approved')
                <i class="fa fa-check text-success"></i>
            @elseif ($appointment->status === 'declined')
                <i class="fa fa-times text-danger"></i>
            @else
                <i class="fa fa-clock-o"></i>
            @endif
        </div>

        @if ($appointment->message)
            <div class="h7">
                Client Message: {{ $appointment->message }}
            </div>
        @endif

        @if ($appointment->architect_message)
            <div class="h7">
                Architect Message: {{ $appointment->architect_message }}
            </div>
        @endif

        <div class="mt-2 d-flex align-items-center" role="group">
            @if ($appointment->link && Carbon\Carbon::parse($appointment->end_date)->isFuture())
                <a href="{{ $appointment->link }}" target="_blank" class="text-decoration-none btn btn-success d-flex align-items-center me-md-2">
                    <i class="fa fa-phone me-2"></i> Join Call
                </a>
            @endif

            @architect
                @if (!auth()->user()->google_token)
                    <div class="d-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Please authenticate AReal to use your Google Calendar to confirm your appointments.">
                        <button type="button" class="btn btn-success d-flex align-items-center me-md-2" disabled><i class="fa fa-check"></i></button>
                        <button type="button" class="btn btn-danger d-flex align-items-center" disabled><i class="fa fa-times"></i></button>
                    </div>
                @elseif ($appointment->status === "pending" && $appointment->architect->id === auth()->id() && Carbon\Carbon::parse($appointment->start_date)->isFuture())
                    <form action="{{ route("appointment.update", $appointment->id) }}" class="me-md-2" method="POST">
                        @csrf
                        @method("PUT")
                        <input type="hidden" name="status" value="approved">
                        <button type="submit" class="btn btn-success d-flex align-items-center"><i class="fa fa-check"></i></button>
                    </form>
                    <div>
                        <button type="button" class="btn btn-danger d-flex align-items-center" data-bs-toggle="collapse" data-bs-target="#declined-collapse-{{ $appointment->id }}"><i class="fa fa-times"></i></button>
                    </div>
                @endif
            @endarchitect
        </div>
        <div class="collapse mt-2" id="declined-collapse-{{ $appointment->id }}">
            <div class="card">
                <div class="card-header">Message to client</div>
                <div class="card-body">
                    <form action="{{ route("appointment.update", $appointment->id) }}" method="POST">
                        @csrf
                        @method("PUT")
                        <input type="hidden" name="status" value="declined" />
                        <textarea name="architect_message" class="form-control mb-2"></textarea>
                        <button type="submit" class="btn btn-danger d-flex align-items-center">Decline</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
