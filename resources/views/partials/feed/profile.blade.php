<div class="mb-2 card">
    <div class="card-body">
        <img src="https://www.perfectpassportphotos.com/img/img_placeholder_avatar.jpg" alt="..."
            class="img-thumbnail">
        <div class="mt-2 mb-0 h5">
            <a href="{{ route('profile.view', $user->id) }}">{{ $user->name }}</a>

            @if($user->hasVerifiedEmail())
                <i class="fa fa-check-circle"></i>
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

    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <div class="h6 text-muted">Meeting Schedule</div>
            <div class="h5">March 10, 2022</div>
            <div class="h7">9:00am - 10:00am with Aeron DickDikan</div>
        </li>
    </ul>
</div>
