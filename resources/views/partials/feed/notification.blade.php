<a href="{{ $notification->data["reference_link"] }}?read={{ $notification->id }}" class="notification">
    <div class="media p-3 mb-1 rounded-3">
        <img class="mr-3 rounded-circle" width="45" src="{{ $notification->data["user_photo"] }}" alt="">
        <div class="media-body">
            @if($notification->read_at)
                {{ $notification->data["message"] }}
            @else
                <strong>
                    {{ $notification->data["message"] }}
                </strong>
            @endif
            <div class="mb-2 text-muted h7"> <i class="fa fa-clock-o"></i> {{ $notification->created_at->diffForHumans() }} ({{ $notification->created_at->toDateTimeString() }})</div>
        </div>
    </div>
</a>

@once
    @push('styles')
        <style>
            .notification:hover {
                text-decoration: none;
            }

            .notification .media {
                background-color: #f7f7f7;
            }

            .notification:hover .media {
                background-color: #e0e0e0;
            }
        </style>
    @endpush
@endonce
