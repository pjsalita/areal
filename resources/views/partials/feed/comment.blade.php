<div class="p-2 my-2 d-flex">
    <a href="{{ route('profile.show', $comment->user->id) }}" class="me-2">
        <img class="rounded-circle" width="45" height="45" src="{{ $comment->user->profile_photo }}" alt="">
    </a>

    <div>
        <a href="{{ route('profile.show', $comment->user->id) }}" class="m-0 fw-bold me-1">{{ $comment->user->name }}</a><span class="m-0">{{ $comment->body }}</span>
        <div class="mb-2 text-muted h7">{{ $comment->created_at->diffForHumans() }} ({{ $comment->created_at->toDateTimeString() }})</div>
    </div>

    @self($comment->user->id)
        <div class="ms-auto">
            <form action="{{ route("comment.destroy", $comment->id) }}" method="POST">
                @csrf
                @method("DELETE")
                <button type="submit" class="btn text-danger btn-link">
                    <i class="fa fa-trash"></i>
                </button>
            </form>
        </div>
    @endself
</div>
