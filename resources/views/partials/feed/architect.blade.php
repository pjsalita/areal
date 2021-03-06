<div class="mb-2 card">
    <div class="card-body">
        <div class="mb-2 d-flex justify-content-between align-items-center">
            <div class="d-flex justify-content-between align-items-center">
                <div class="me-2">
                    <a href="{{ route('profile.show', $architect->id) }}">
                        <img class="rounded-circle" width="45" height="45" src="{{ $architect->profile_photo }}" alt="">
                    </a>
                </div>
                <div class="ms-2">
                    <div class="m-0 h5">
                        <a href="{{ route('profile.show', $architect->id) }}">{{ $architect->name }}</a>
                    </div>
                    <div class="h7 text-muted text-capitalize">{{ $architect->position }}</div>
                </div>
            </div>
        </div>
        <p class="card-text">
            <div class="h7 text-muted">Contact Number : <a href="tel:{{ $architect->phone_number }}">{{ $architect->phone_number }}</a></div>
            <div class="h7 text-muted">Email : <a href="mailto:{{ $architect->email }}">{{ $architect->email }}</a></div>
            @if($architect->address)
                <div class="h7 text-muted">Office Address : Blk 10 Lot 8 Sapang matakla, Planet Namec</div>
            @endif
        </p>
        @verified
            <a href="{{ route("chat") }}/{{ $architect->id }}" id="openChat" class="card-link text-decoration-none">
                <i class="fa fa-comments"></i>
            </a>
            <a href="#" class="card-link text-decoration-none" data-bs-toggle="modal" data-bs-target="#bookAppointment" onclick="$('#book-architect-id')[0].value = {{ $architect->id }}">
                <i class="fa fa-calendar"></i>
            </a>
        @else
            <a href="javascript:void(0)" id="openChat" class="card-link text-decoration-none" data-bs-toggle="tooltip" data-bs-placement="top" title="Verify your email to chat architect.">
                <i class="fa fa-comments"></i>
            </a>
            <a href="javascript:void(0)" class="card-link text-decoration-none" data-bs-toggle="tooltip" data-bs-placement="top" title="Verify your email to book appointment.">
                <i class="fa fa-calendar"></i>
            </a>
        @endverified
    </div>
</div>
