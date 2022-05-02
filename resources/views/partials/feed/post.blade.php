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

            <div class="float-right btn-group">
                @if ($post->type === 'design')
                <div data-bs-toggle="dropdown">
                    <button class="btn btn-link dropdown-toggle" data-bs-toggle="tooltip" data-bs-placement="left" title="Get QR Code.">
                        <i class="fa fa-qrcode"></i>
                    </button>
                </div>
                @endif
                <div class="p-0 dropdown-menu">
                    <div class="d-flex flex-column">
                        <div class="qrcode img-thumbnail">
                            {!! QrCode::size(250)->generate("userDesign:" . $post->id) !!}
                        </div>
                        <button class="btn btn-primary" onclick="downloadQr(event, '{{ $post->title }}')">
                            Download QR Code
                        </button>
                    </div>
                </div>
                @self($post->user->id)
                    <form action="{{ route("post.destroy", $post->id) }}" method="POST">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn text-danger btn-link">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                @endself
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="mb-2 text-muted h7"> <i class="fa fa-clock-o"></i> {{ $post->created_at->diffForHumans() }} ({{ $post->created_at->toDateTimeString() }})</div>
        <a class="card-link" href="{{ route("{$post->type}.show", $post->id) }}">
            <h5 class="card-title d-inline-block">{{ $post->title }}</h5>
        </a>

        <p class="card-text">{{ $post->body }}</p>

        @if ($post->measurements)
            <p>
                <strong><small>Height:</small></strong> <small class="text-muted">{{ $post->measurements->height }}</small>
                <strong class="ms-5"><small>Length:</small></strong> <small class="text-muted">{{ $post->measurements->length }}</small>
                <strong class="ms-5"><small>Width:</small></strong> <small class="text-muted">{{ $post->measurements->width }}</small>
                <strong class="ms-5"><small>Square Meters:</small></strong> <small class="text-muted">{{ $post->measurements->square_meters }}</small>
            </p>
        @endif

        @if ($post->attachments->count())
            {{-- @foreach ($post->attachments()->models()->get() as $attachment)
                <a href="{{ $attachment->file }}" class="file-download text-decoration-none">
                    <span class="fa fa-file"></span> {{ $attachment->filename }}
                </a>
            @endforeach --}}

            <div class="row">
                @foreach ($post->attachments()->images()->get() as $attachment)
                    <div class="mb-4 col-6 position-relative">
                        @if (substr($attachment->filename, strrpos($attachment->filename, '.') + 1) === 'mp4')
                            <video src="{{ $attachment->file }}" alt="" class="img-thumbnail w-100 h-100" style="max-width: 100%; max-height: 500px;" controls></video>
                        @else
                            <img src="{{ $attachment->file }}" alt="" class="img-thumbnail w-100 h-100" style="max-width: 100%; max-height: 500px;" />
                            <a href="{{ $attachment->file }}" class="stretched-link" target="_blank"></a>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <div class="card-footer d-flex">
        @client
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
                <a href="javascript:void(0)" class="card-link d-flex align-items-center text-decoration-none" style="cursor: default" data-bs-toggle="tooltip" data-bs-placement="top" title="Verify your email address to like and comment.">
                    <i class="fa fa-gittip me-1"></i> Like <span class="ms-2 badge rounded-pill bg-secondary">{{ $post->likes->count() }}</span>
                </a>
            @endverified
        @endclient

        @architect
            @activated
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
                <a href="javascript:void(0)" class="card-link d-flex align-items-center text-decoration-none" style="cursor: default" data-bs-toggle="tooltip" data-bs-placement="top" title="Your email address and PRC ID must be verified to like and comment.">
                    <i class="fa fa-gittip me-1"></i> Like <span class="ms-2 badge rounded-pill bg-secondary">{{ $post->likes->count() }}</span>
                </a>
            @endactivated
        @endarchitect

        @guest
            <a href="javascript:void(0)" class="card-link d-flex align-items-center text-decoration-none" style="cursor: default" data-bs-toggle="tooltip" data-bs-placement="top" title="Login or register to like and comment.">
                <i class="fa fa-gittip me-1"></i> Like <span class="ms-2 badge rounded-pill bg-secondary">{{ $post->likes->count() }}</span>
            </a>
        @endguest

        <a href="javascript:void(0)" onClick="toggleComment({{ $post->id }})" class="card-link d-flex align-items-center text-decoration-none">
            <i class="fa fa-comment me-1"></i> Comment <span class="ms-2 badge rounded-pill bg-secondary">{{ $post->comments->count()}}</span>
        </a>
    </div>

    <div id="post-comments-{{ $post->id }}" class="comment-container {{ request()->routeIs("{$post->type}.show") ? "" : "d-none"}}">
        @foreach($post->comments as $comment)
            @include("partials.feed.comment", [ 'comment' => $comment ])
        @endforeach

        @client
            @verified
                <form class="p-2 d-inline-flex align-items-center w-100 bg-gray" method="POST" action="{{ route("comment.store") }}" autocomplete="off">
                    @csrf
                    <img class="rounded-circle" width="45" height="45" src="{{  auth()->user()->profile_photo }}" alt="">
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <textarea type="text" class="mx-2 flex-grow-1 form-control" name="body" placeholder="Leave a comment..." rows="1" required></textarea>

                    <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i></button>
                </form>
            @else
                <div class="p-2 bg-gray">
                    <small>Verify your email address to like and comment.</small>
                </div>
            @endverified
        @endclient

        @architect
            @activated
                <form class="p-2 d-inline-flex align-items-center w-100 bg-gray" method="POST" action="{{ route("comment.store") }}" autocomplete="off">
                    @csrf
                    <img class="rounded-circle" width="45" height="45" src="{{  auth()->user()->profile_photo }}" alt="">
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <textarea type="text" class="mx-2 flex-grow-1 form-control" name="body" placeholder="Leave a comment..." rows="1" required></textarea>

                    <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i></button>
                </form>
            @else
                <div class="p-2 bg-gray">
                    <small>Your email address and PRC ID must be verified to like and comment.</small>
                </div>
            @endactivated
        @endarchitect

        @guest
            <div class="p-2 bg-gray">
                <small>Login or register to like and comment.</small>
            </div>
        @endguest
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
