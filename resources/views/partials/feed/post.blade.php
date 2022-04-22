<div class="mb-3 card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex justify-content-between align-items-center">
                <div class="me-2">
                    <a href="{{ route('profile.show', $post->user->id) }}">
                        <img class="rounded-circle" width="45" height="45" src="{{  $post->user->profile_photo }}" alt="">
                    </a>
                </div>
                <div class="ms-2">
                    <div class="m-0 h5">
                        <a href="{{ route('profile.show', $post->user->id) }}">{{ $post->user->name }}</a>
                    </div>
                    <div class="h7 text-muted text-capitalize">{{ $post->user->position }}</div>
                </div>
            </div>

            @self($post->user->id)
                <div class="float-right">
                    <form action="{{ route("post.destroy", $post->id) }}" method="POST">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn text-danger btn-link">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                </div>
            @endself
        </div>
    </div>

    <div class="card-body">
        <div class="mb-2 text-muted h7"> <i class="fa fa-clock-o"></i> {{ $post->created_at->diffForHumans() }} ({{ $post->created_at->toDateTimeString() }})</div>
        <a class="card-link" href="{{ route("post.show", $post->id) }}">
            <h5 class="card-title d-inline-block">{{ $post->title }}</h5>
        </a>

        <p class="card-text">{{ $post->body }}</p>

        @if ($post->attachments->count())
            <div class="row">
                @foreach ($post->attachments as $attachment)
                    <div class="mb-4 col-3 position-relative">
                        @if ($attachment->type === "image")
                            <img src="{{ $attachment->file }}" alt="" class="img-thumbnail w-100 h-100" />
                            <a href="{{ $attachment->file }}" class="stretched-link" target="_blank"></a>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <div class="card-footer d-flex">
        @verified
            @can('like', $post)
                <a href="javascript:void(0)" onClick="like(this, {{ $post->id }})" class="card-link d-flex align-items-center text-decoration-none">
                    <i class="fa fa-gittip me-1"></i> Like
                        <span class="ms-2 badge rounded-pill bg-secondary">{{ $post->likes->count() }}</span>
                </a>
            @else
                <a href="javascript:void(0)" onClick="like(this, {{ $post->id }})" class="card-link d-flex align-items-center text-decoration-none text-danger">
                    <i class="fa fa-gittip me-1"></i> Like
                        <span class="ms-2 badge rounded-pill bg-danger">{{ $post->likes->count() }}</span>
                </a>
            @endcan
        @else
            @auth
                <a href="javascript:void(0)" class="card-link d-flex align-items-center text-decoration-none" style="cursor: default" data-bs-toggle="tooltip" data-bs-placement="top" title="Verify your email address to like and comment.">
                    <i class="fa fa-gittip me-1"></i> Like <span class="ms-2 badge rounded-pill bg-secondary">{{ $post->likes->count() }}</span>
                </a>
            @else
                <a href="javascript:void(0)" class="card-link d-flex align-items-center text-decoration-none" style="cursor: default" data-bs-toggle="tooltip" data-bs-placement="top" title="Login or register to like and comment.">
                    <i class="fa fa-gittip me-1"></i> Like <span class="ms-2 badge rounded-pill bg-secondary">{{ $post->likes->count() }}</span>
                </a>
            @endauth
        @endverified

        <a href="javascript:void(0)" onClick="toggleComment({{ $post->id }})" class="card-link d-flex align-items-center text-decoration-none">
            <i class="fa fa-comment me-1"></i> Comment <span class="ms-2 badge rounded-pill bg-secondary">{{ $post->comments->count()}}</span>
        </a>
    </div>

    <div id="post-comments-{{ $post->id }}" class="comment-container {{ request()->routeIs("post.show") ? "" : "d-none"}}">
        @foreach($post->comments as $comment)
            @include("partials.feed.comment", [ 'comment' => $comment ])
        @endforeach

        @verified
            <form class="p-2 d-inline-flex align-items-center w-100 bg-gray" method="POST" action="{{ route("comment.store") }}" autocomplete="off">
                @csrf
                <img class="rounded-circle" width="45" height="45" src="{{  auth()->user()->profile_photo }}" alt="">
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <textarea type="text" class="mx-2 flex-grow-1 form-control" name="body" placeholder="Leave a comment..." rows="1" required></textarea>

                <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i></button>
            </form>
        @else
            @auth
                <div class="p-2 bg-gray">
                    <small>Verify your email address to like and comment.</small>
                </div>
            @else
                <div class="p-2 bg-gray">
                    <small>Login or register to like and comment.</small>
                </div>
            @endauth
        @endverified
    </div>
</div>

@once
    @push('scripts')
        <script>
            async function like(el, id) {
                const badge = el.querySelector(".badge");

                if (badge.classList.contains("bg-danger")) {
                    const { data } = await axios.delete("/like", {
                        data: {
                            id,
                            likeable_type: "App\\Models\\Post"
                        }
                    });
                    badge.innerText = data.likes;
                } else {
                    const { data } = await axios.post("/like", { id, likeable_type: "App\\Models\\Post" });
                    badge.innerText = data.likes;
                }

                el.classList.toggle("text-danger");
                badge?.classList?.toggle("bg-secondary");
                badge?.classList?.toggle("bg-danger");
            }

            function toggleComment(id) {
                const comments = document.getElementById(`post-comments-${id}`);
                comments?.classList?.toggle("d-none");
            }
        </script>
    @endpush
@endonce
