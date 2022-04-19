<!--- Markup for Create Post-->
@verified
<div class="card gedf-card">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs" id="myPostTab" role="tablist">
            <li class="nav-item">
                <button class="nav-link active" id="posts-tab" data-bs-toggle="tab" data-bs-target="#posts" type="button" role="tab" aria-controls="posts" aria-selected="true">
                    Create post
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="images-tab" data-bs-toggle="tab" data-bs-target="#images" type="button" role="tab" aria-controls="images" aria-selected="true">
                    Images
                </button>
            </li>
        </ul>
    </div>
    <form class="card-body" method="POST" action="{{ route('post.store') }}">
        @csrf
        <div class="tab-content" id="myPostTabContent">
            <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                <div class="form-group">
                    <label class="sr-only" for="message">post</label>
                    <input class="mb-2 form-control" name="title" placeholder="Subject" required/>
                    <textarea class="form-control" name="body" id="message" rows="3" placeholder="What are you thinking?"></textarea>
                </div>

            </div>
            <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
                <div class="input-group">
                    <input type="file" class="form-control" id="customFile">
                    <label class="input-group-text" for="customFile">Upload</label>
                  </div>
            </div>
        </div>
        <div class="mt-2">
            <button type="submit" class="btn btn-primary">Post</button>
        </div>
    </form>
</div>

@else

<div class="card gedf-card">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs" id="myPostTab" role="tablist">
            <li class="nav-item">
                <button class="nav-link active" id="posts-tab" data-bs-toggle="tab" data-bs-target="#posts" type="button" role="tab" aria-controls="posts" aria-selected="true">
                    Create post
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="images-tab" data-bs-toggle="tab" data-bs-target="#images" type="button" role="tab" aria-controls="images" aria-selected="true">
                    Images
                </button>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="myPostTabContent">
            <div class="m-0 alert alert-warning" role="alert">
                Verify your email address to post.
            </div>
        </div>
    </div>
</div>
@endverified
