<div class="card mb-2">
    <div class="card-header">
        <h5 class="m-0"><a href="{{ route("appointment.show", $appointment->id) }}">{{ Carbon\Carbon::parse($appointment->end_date)->format('F d, Y') }}</a></h5>
        <p class="d-inline text-muted h7" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $appointment->created_at->toDateTimeString() }}"> <i class="fa fa-clock-o"></i> {{ $appointment->created_at->diffForHumans() }}</p>
    </div>
    <div class="card-body">
        <div class="h7">
            Time: {{ Carbon\Carbon::parse($appointment->start_date)->format('h:iA') }} - {{ Carbon\Carbon::parse($appointment->end_date)->format('h:iA') }}
        </div>
        <div class="h7">
            Architect: <a href="{{ route("profile.show", $appointment->architect->id) }}">{{ $appointment->architect->name }}</a>
        </div>
        <div class="h7">
            Client: <a href="{{ route("profile.show", $appointment->client->id) }}">{{ $appointment->client->name }}</a>
        </div>
        <div class="h7">
            Message: {{ $appointment->message }}
        </div>
        <div class="h7">
            Approved:
            @if ($appointment->status === 'approved')
                <i class="fa fa-check text-success"></i>
            @elseif ($appointment->status === 'declined')
                <i class="fa fa-times text-danger"></i>
            @else
                <i class="fa fa-clock-o"></i>
            @endif
        </div>

        @architect
        @if ($appointment->status === "pending" && $appointment->architect->id === auth()->id())
            <div class="d-flex align-items-center justify-content-between mt-2" role="group">
                <form action="{{ route("appointment.update", $appointment->id) }}" class="me-md-2" method="POST">
                    @csrf
                    @method("PUT")
                    <input type="hidden" name="status" value="approved">
                    <button type="submit" class="btn btn-success d-flex align-items-center"><i class="fa fa-check"></i></button>
                </form>
                <form action="{{ route("appointment.update", $appointment->id) }}" method="POST">
                    @csrf
                    @method("PUT")
                    <input type="hidden" name="status" value="declined">
                    <button type="submit" class="btn btn-danger d-flex align-items-center"><i class="fa fa-times"></i></button>
                </form>
            </div>
        @endif
        @endarchitect
    </div>
</div>
