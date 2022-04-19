<div class="p-3 mb-2 d-flex rounded-3 notification position-relative">
    <div>
        <img class="me-3 rounded-circle" width="45" src="{{ $notification->data["user_photo"] }}" alt="">
    </div>
    <div class="media-body">
        <a href="{{ $notification->data["reference_link"] }}?read={{ $notification->id }}" class="stretched-link">
            @if($notification->read_at)
                {{ $notification->data["message"] }}
            @else
                <strong>
                    {{ $notification->data["message"] }}
                </strong>
            @endif
        </a>
        <div class="mb-2 text-muted h7"> <i class="fa fa-clock-o"></i> {{ $notification->created_at->diffForHumans() }} ({{ $notification->created_at->toDateTimeString() }})</div>
    </div>
</div>

@once
    @push('styles')
        <style>
            .notification a:hover {
                text-decoration: none;
            }

            .notification {
                background-color: #f7f7f7;
                transition: 0.1s;
            }

            .notification:hover {
                background-color: #e0e0e0;
            }
        </style>
    @endpush
@endonce
