<div class="media p-2 my-2">
    <a href="{{ route('profile.show', $comment->user->id) }}">
        <img class="mr-3 rounded-circle" width="45"  src="{{ $comment->user->profile_photo }}" alt="">
    </a>

    <div class="media-body">
        <a href="{{ route('profile.show', $comment->user->id) }}" class="font-weight-bold mr-1 m-0">{{ $comment->user->name }}</a><span class="m-0">{{ $comment->body }}</span>
        <div class="mb-2 text-muted h7">{{ $post->created_at->diffForHumans() }} ({{ $post->created_at->toDateTimeString() }})</div>
    </div>

    @self($comment->user->id)
        <div class="float-right">
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
