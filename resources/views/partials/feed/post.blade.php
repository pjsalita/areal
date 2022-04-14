<div class="mb-2 card gedf-card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex justify-content-between align-items-center">
                <div class="mr-2">
                    <img class="rounded-circle" width="45" src="https://picsum.photos/50/50" alt="">
                </div>
                <div class="ml-2">
                    <div class="m-0 h5">
                        <a href="{{ route('profile.view', $user->id) }}">{{ $user->name }}</a>
                    </div>

                    <div class="h7 text-muted text-capitalize">{{ $user->position }}</div>
                </div>
            </div>
        </div>

    </div>
    <div class="card-body">
        <div class="mb-2 text-muted h7"> <i class="fa fa-clock-o"></i> {{ $post->created_at->diffForHumans() }}</div>
        <a class="card-link" href="#">
            <h5 class="card-title">{{ $post->title }}</h5>
        </a>

        <p class="card-text">{{ $post->body }}</p>
    </div>

    @verified
        <div class="card-footer">
            <a href="#" class="card-link"><i class="fa fa-gittip"></i> Like</a>
            <a href="#" class="card-link"><i class="fa fa-comment"></i> Comment</a>
        </div>
    @else
        <div class="card-footer">
            <small>Verify your email address to like and comment.</small>
        </div>
    @endverified
</div>
