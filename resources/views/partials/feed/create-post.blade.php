<!--- Markup for Create Post-->
@verified
<div class="card gedf-card">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab"
                    aria-controls="posts" aria-selected="true">Create post</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="images-tab" data-toggle="tab" role="tab" aria-controls="images"
                    aria-selected="false" href="#images">Images</a>
            </li>
        </ul>
    </div>
    <form class="card-body" method="POST" action="{{ route('post.store') }}">
        @csrf
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                <div class="form-group">
                    <label class="sr-only" for="message">post</label>
                    <input class="mb-2 form-control" name="title" placeholder="Subject" required/>
                    <textarea class="form-control" name="body" id="message" rows="3" placeholder="What are you thinking?"></textarea>
                </div>

            </div>
            <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
                <div class="form-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Upload image</label>
                    </div>
                </div>
                <div class="py-4"></div>
            </div>
        </div>
        <div class="btn-toolbar justify-content-between">
            <div class="btn-group">
                <button type="submit" class="btn btn-primary">Post</button>
            </div>
        </div>
    </form>
</div>

@else

<div class="card gedf-card">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab"
                    aria-controls="posts" aria-selected="true">Create post</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="images-tab" data-toggle="tab" role="tab" aria-controls="images"
                    aria-selected="false" href="#images">Images</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="myTabContent">
            <div class="m-0 alert alert-warning" role="alert">
                Verify your email address to post.
            </div>
        </div>
    </div>
</div>

@endverified
