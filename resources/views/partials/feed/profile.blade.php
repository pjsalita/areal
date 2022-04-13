<div class="card">
    <div class="card-body">
        <img src="https://www.perfectpassportphotos.com/img/img_placeholder_avatar.jpg" alt="..."
            class="img-thumbnail">
        <div class="h5 mt-2 mb-0">{{ auth()->user()->name }}</div>

        @if(auth()->user()->phone_number)
            <div class="h7 text-muted">Contact Number : {{ auth()->user()->phone_number }}</div>
        @endif

        <div class="h7 text-muted">Email : {{ auth()->user()->email }}</div>

        @if(auth()->user()->address)
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
